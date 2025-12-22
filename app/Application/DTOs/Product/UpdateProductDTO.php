<?php

namespace App\Application\DTOs\Product;

class UpdateProductDTO
{
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $slug = null,
        public readonly ?string $description = null,
        public readonly ?float $price = null,
        public readonly ?int $stock = null,
        public readonly ?int $categoryId = null,
        public readonly ?string $imageUrl = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'] ?? null,
            slug: $data['slug'] ?? null,
            description: $data['description'] ?? null,
            price: isset($data['price']) ? (float) $data['price'] : null,
            stock: isset($data['stock']) ? (int) $data['stock'] : null,
            categoryId: isset($data['category_id']) ? (int) $data['category_id'] : null,
            imageUrl: $data['image_url'] ?? null,
        );
    }

    public function toArray(): array
    {
        $array = [];

        if ($this->name !== null) {
            $array['name'] = $this->name;
        }
        if ($this->slug !== null) {
            $array['slug'] = $this->slug;
        }
        if ($this->description !== null) {
            $array['description'] = $this->description;
        }
        if ($this->price !== null) {
            $array['price'] = $this->price;
        }
        if ($this->stock !== null) {
            $array['stock'] = $this->stock;
        }
        if ($this->categoryId !== null) {
            $array['category_id'] = $this->categoryId;
        }
        if ($this->imageUrl !== null) {
            $array['image_url'] = $this->imageUrl;
        }

        return $array;
    }
}

