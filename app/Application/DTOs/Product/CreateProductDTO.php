<?php

namespace App\Application\DTOs\Product;

class CreateProductDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $slug,
        public readonly ?string $description,
        public readonly float $price,
        public readonly int $stock,
        public readonly int $categoryId,
        public readonly ?string $imageUrl,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            slug: $data['slug'],
            description: $data['description'] ?? null,
            price: (float) $data['price'],
            stock: (int) $data['stock'],
            categoryId: (int) $data['category_id'],
            imageUrl: $data['image_url'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'category_id' => $this->categoryId,
            'image_url' => $this->imageUrl,
        ];
    }
}

