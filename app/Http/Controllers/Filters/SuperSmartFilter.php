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
            default:
                $type = Schema::getColumnType($this->table, $field);
                if (in_array($type, ['string', 'text'])) {
                    $this->builder->where($field, 'like', "%$value%");
                } elseif (in_array($type, ['date', 'datetime'])) {
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
            $sortBy = $this->request->input('sort_by');
            $sortDir = $this->request->input('sort_dir');

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
}

