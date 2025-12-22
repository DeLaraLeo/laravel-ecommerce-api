<?php

namespace App\Application\DTOs\Category;

class UpdateCategoryDTO
{
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $slug = null,
        public readonly ?string $description = null,
        public readonly ?int $parentId = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'] ?? null,
            slug: $data['slug'] ?? null,
            description: $data['description'] ?? null,
            parentId: isset($data['parent_id']) ? (int) $data['parent_id'] : null,
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
        if ($this->parentId !== null) {
            $array['parent_id'] = $this->parentId;
        }

        return $array;
    }
}

