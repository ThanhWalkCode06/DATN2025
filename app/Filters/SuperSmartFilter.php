<?php

namespace App\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class SuperSmartFilter
{
    protected $request;
    protected $builder;
    protected $model;
    protected $table;
    protected $columns;
    protected $whitelist = [];
    protected $blacklist = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    protected function setModel($model)
    {
        $this->model = $model;
        $this->table = $model->getTable();
        return $this;
    }

    protected function setColumns($columns)
    {
        $this->columns = $columns;
        return $this;
    }

    public function apply(Builder $builder)
    {
        $this->builder = $builder;
        $this->model = $builder->getModel();
        $this->table = $this->model->getTable();
        $this->columns = Schema::getColumnListing($this->table);

        foreach ($this->request->all() as $key => $value) {
            if ($value === null || $value === '') continue;

            $this->handleFilter($key, $value);
        }

        $this->handleSorting();

        return $this->builder;
    }

    // Xử lý whitelist, blacklist
    public function whitelist(array $fields)
    {
        $this->whitelist = $fields;
        return $this;
    }

    public function blacklist(array $fields)
    {
        $this->blacklist = $fields;
        return $this;
    }

    // Lọc các tham số truy vấn
    protected function handleFilter($key, $value)
    {
        if (is_array($value)) {
            $value = implode(',', $value); // đảm bảo luôn là chuỗi khi xử lý _in
        }

        // Kiểm tra nếu key chứa dấu chấm (quan hệ)
        if (Str::contains($key, '.')) {
            $this->applyRelationshipFilter($key, $value);
            return;
        }

        $field = $this->getBaseField($key);

        if (!in_array($field, $this->columns)) return;
        if (!empty($this->whitelist) && !in_array($field, $this->whitelist)) return;
        if (in_array($field, $this->blacklist)) return;

        // Thực hiện lọc với operator
        switch (true) {
            case Str::endsWith($key, '_gt'):
                $this->builder->where($field, '>', $value); break;
            case Str::endsWith($key, '_lt'):
                $this->builder->where($field, '<', $value); break;
            case Str::endsWith($key, '_gte'):
                $this->builder->where($field, '>=', $value); break;
            case Str::endsWith($key, '_lte'):
                $this->builder->where($field, '<=', $value); break;
            case Str::endsWith($key, '_in'):
                $this->builder->whereIn($field, explode(',', $value)); break;
            case Str::endsWith($key, '_not_in'):
                $this->builder->whereNotIn($field, explode(',', $value)); break;
            case Str::endsWith($key, '_from'):
                $this->builder->where($field, '>=', $value); break;
            case Str::endsWith($key, '_to'):
                $this->builder->where($field, '<=', $value); break;

            default:
                $type = Schema::getColumnType($this->table, $field);
                if (in_array($type, ['string', 'text', 'varchar'])) {
                    $this->builder->where($field, 'like', "%$value%");
                } elseif (in_array($type, ['date', 'datetime', 'timestamp']) && strtotime($value)) {
                    $this->builder->whereDate($field, $value);
                } else {
                    $this->builder->where($field, '=', $value);
                }
        }
    }

    // Xử lý sorting
    protected function handleSorting()
    {
        if ($this->request->has('sort_by') && $this->request->has('sort_dir')) {
            $sortBy = $this->request->input('sort_by','created_at');
            $sortDir = $this->request->input('sort_dir','desc');

            if (in_array($sortBy, $this->columns) && in_array($sortDir, ['asc', 'desc'])) {
                $this->builder->orderBy($sortBy, $sortDir);
            }
        }
    }

    // Tìm kiếm trường cơ bản trong query
    protected function getBaseField($key)
    {
        foreach (['_gt', '_lt', '_gte', '_lte', '_from', '_to', '_in', '_not_in'] as $suffix) {
            if (Str::endsWith($key, $suffix)) {
                return Str::replaceLast($suffix, '', $key);
            }
        }
        return $key;
    }

    protected function applyRelationshipFilter($key, $value)
    {
        $parts = explode('.', $key);
        $relation = $parts[0]; // Chỉ lấy quan hệ trực tiếp

        // Xử lý đặc biệt cho Spatie roles/permissions
        if ($relation === 'roles') {
            $this->applySpatieRoleFilter($parts, $value);
            return;
        }

        // Kiểm tra quan hệ tồn tại
        if (!method_exists($this->model, $relation)) {
            return;
        }

        $field = $this->getBaseField($parts[1] ?? $parts[0]);

        $this->builder->whereHas($relation, function ($query) use ($field, $value) {
            $filter = new static($this->request);
            $filter->setModel($query->getModel())
                ->setColumns(Schema::getColumnListing($query->getModel()->getTable()))
                ->applyWhereConditions($query, $field, $value);
        });
    }

    protected function applySpatieRoleFilter($parts, $value)
    {
        $roleIds = is_array($value) ? $value : explode(',', $value);

        $this->builder->whereHas('roles', function($query) use ($roleIds) {
            $query->whereIn(
                config('permission.table_names.roles').'.id',
                $roleIds
            );
        });
    }

    protected function applyWhereConditions($query, $field, $value)
    {
        $baseField = $this->getBaseField($field);

        if (!in_array($baseField, $this->columns)) return;

        switch (true) {
            case Str::endsWith($field, '_gt'):
                $query->where($baseField, '>', $value); break;
            case Str::endsWith($field, '_lt'):
                $query->where($baseField, '<', $value); break;
            case Str::endsWith($field, '_gte'):
                $query->where($baseField, '>=', $value); break;
            case Str::endsWith($field, '_lte'):
                $query->where($baseField, '<=', $value); break;
            case Str::endsWith($field, '_in'):
                $query->whereIn($baseField, explode(',', $value)); break;
            case Str::endsWith($field, '_not_in'):
                $query->whereNotIn($baseField, explode(',', $value)); break;
            case Str::endsWith($field, '_from'):
                $query->where($baseField, '>=', $value); break;
            case Str::endsWith($field, '_to'):
                $query->where($baseField, '<=', $value); break;
            default:
                $type = Schema::getColumnType($this->table, $baseField);
                if (in_array($type, ['string', 'text', 'varchar'])) {
                    $query->where($baseField, 'like', "%$value%");
                } elseif (in_array($type, ['date', 'datetime', 'timestamp']) && strtotime($value)) {
                    $query->whereDate($baseField, $value);
                } else {
                    $query->where($baseField, '=', $value);
                }
        }
    }


}

