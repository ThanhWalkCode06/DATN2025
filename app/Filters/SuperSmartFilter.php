<?php

namespace App\Filters;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Builder;

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

    protected function handleFilter($key, $value)
    {
        if (is_array($value)) {
            $value = implode(',', $value);
        }

        if ($key === 'role') {
            $this->applyRoleFilter($value);
            return;
        }

        // Kiểm tra cột cơ bản (không có hậu tố) cho whitelist/blacklist và columns
        $baseField = $this->getBaseField($key);
        if (!in_array($baseField, $this->columns)) {
            Log::warning("Field $baseField not found in columns of table $this->table");
            return;
        }

        if (!empty($this->whitelist) && !in_array($baseField, $this->whitelist)) return;
        if (in_array($baseField, $this->blacklist)) return;

        // Truyền $key gốc (bao gồm hậu tố) vào applyWhereConditions
        $this->applyWhereConditions($this->builder, $key, $value);
    }

    protected function handleSorting()
    {
        if ($this->request->has('sort_by') && $this->request->has('sort_dir')) {
            $sortBy = $this->request->input('sort_by', 'created_at');
            $sortDir = $this->request->input('sort_dir', 'desc');

            if (in_array($sortBy, $this->columns) && in_array($sortDir, ['asc', 'desc'])) {
                $this->builder->orderBy($sortBy, $sortDir);
            }
        }
    }

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
        Log::info("Applying relationship filter: key=$key, value=$value");
        $parts = explode('.', $key);
        $relationChain = array_slice($parts, 0, -1);
        $fieldWithOperator = end($parts);
        $this->applyNestedRelationship($this->builder, $relationChain, $fieldWithOperator, $value);
    }

    protected function applyNestedRelationship($builder, $relationChain, $fieldWithOperator, $value)
    {
        $currentRelation = array_shift($relationChain);
        Log::info("Applying nested relationship: relation=$currentRelation, field=$fieldWithOperator, value=$value");

        if (!method_exists($this->model, $currentRelation)) {
            Log::warning("Relation $currentRelation does not exist on model " . get_class($this->model));
            return;
        }

        $builder->whereHas($currentRelation, function ($query) use ($relationChain, $fieldWithOperator, $value) {
            $relatedModel = $query->getModel();
            $filter = new static($this->request);
            $filter->setModel($relatedModel)
                   ->setColumns(Schema::getColumnListing($relatedModel->getTable()));

            if (empty($relationChain)) {
                $filter->applyWhereConditions($query, $fieldWithOperator, $value);
            } else {
                $filter->applyNestedRelationship($query, $relationChain, $fieldWithOperator, $value);
            }
        });
    }

    protected function applyWhereConditions($query, $field, $value)
    {
        $baseField = $this->getBaseField($field);
        if (!in_array($baseField, $this->columns)) {
            Log::warning("Field $baseField not found in columns of table $this->table");
            return;
        }

        switch (true) {
            case Str::endsWith($field, '_gt'):
                $query->where($baseField, '>', $value);
                break;
            case Str::endsWith($field, '_lt'):
                $query->where($baseField, '<', $value);
                break;
            case Str::endsWith($field, '_gte'):
                $query->where($baseField, '>=', $value);
                break;
            case Str::endsWith($field, '_lte'):
                $query->where($baseField, '<=', $value);
                break;
            case Str::endsWith($field, '_in'):
                $query->whereIn($baseField, explode(',', $value));
                break;
            case Str::endsWith($field, '_not_in'):
                $query->whereNotIn($baseField, explode(',', $value));
                break;
            case Str::endsWith($field, '_from'):
                $query->where($baseField, '>=', $value);
                break;
            case Str::endsWith($field, '_to'):
                $query->where($baseField, '<=', $value);
                break;
            default:
                $type = Schema::getColumnType($this->table, $baseField);
                Log::info("Column type for $baseField: $type");
                if (in_array($type, ['string', 'text', 'varchar'])) {
                    $query->where($baseField, 'like', "%$value%");
                } elseif (in_array($type, ['date', 'datetime', 'timestamp']) && strtotime($value)) {
                    $query->whereDate($baseField, $value);
                } else {
                    Log::info("Applying exact match: $baseField = $value");
                    $query->where($baseField, '=', $value);
                }
        }
    }

    protected function applyRoleFilter($value)
    {
        Log::info("Applying role filter: value=$value");
        if ($value !== '') { // Bỏ qua nếu chọn "-- Tất cả --"
            $this->builder->whereHas('roles', function ($query) use ($value) {
                $query->where('id', $value); // Lọc theo role_id
            });
        }
    }
}
