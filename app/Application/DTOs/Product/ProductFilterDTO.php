<?php

namespace App\Application\DTOs\Product;

class ProductFilterDTO
{
    public function __construct(
        public readonly ?int $category = null,
        public readonly ?float $minPrice = null,
        public readonly ?float $maxPrice = null,
        public readonly ?string $search = null,
        public readonly ?string $sort = null,
        public readonly int $page = 1,
        public readonly int $perPage = 15,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            category: isset($data['category']) ? (int) $data['category'] : null,
            minPrice: isset($data['min_price']) ? (float) $data['min_price'] : null,
            maxPrice: isset($data['max_price']) ? (float) $data['max_price'] : null,
            search: $data['search'] ?? null,
            sort: $data['sort'] ?? null,
            page: isset($data['page']) ? (int) $data['page'] : 1,
            perPage: isset($data['per_page']) ? (int) $data['per_page'] : 15,
        );
    }

    public function toArray(): array
    {
        $array = [];

        if ($this->category !== null) {
            $array['category'] = $this->category;
        }
        if ($this->minPrice !== null) {
            $array['min_price'] = $this->minPrice;
        }
        if ($this->maxPrice !== null) {
            $array['max_price'] = $this->maxPrice;
        }
        if ($this->search !== null) {
            $array['search'] = $this->search;
        }
        if ($this->sort !== null) {
            $array['sort'] = $this->sort;
        }
        $array['page'] = $this->page;
        $array['per_page'] = $this->perPage;

        return $array;
    }
}

