<?php

namespace App\Repository\Store;

use App\Models\AbstractModel;
use App\Repository\AbstractRepository;
use App\Pay\PendingReviewRecords\PendingReviewRecord;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class BookRepository extends AbstractRepository
{
    /**
     * @param  Book  $book
     * @param  array $attributes
     * @return array
     */
    protected function validate($book, $attributes)
    {
        $attributes = validator(
            $attributes,
            [
                'store_id' => ['nullable', Rule::exists('stores', 'id')],
                'user_id' => ['nullable', Rule::exists('users', 'id')],
                'name' => [Rule::requiredIf(!$book->exists), 'string', 'max:64',],
                'barcode' => ['nullable', 'string', 'max:64'],
                'pages_number' => [Rule::requiredIf(!$book->exists), 'numeric'],
                'published' => ['sometimes', 'boolean'],
            ]
        )->validate();

        return $attributes;
    }

    /**
     * @param  Book  $book
     * @param  array $data
     * @return mixed|void
     */
    protected function store($book, $data)
    {
        $book->fill(Arr::except($data, []))->save();

        return $book;
    }

    /**
     * Draft Update an existing entity.
     *
     * @param Book $book
     * @param $attributes
     */
    public function draftUpdate($book, $attributes)
    {
        $data = $this->validate($book, $attributes);

        $book->pendingReviewRecord()->updateOrCreate(
            [
                'payload' => $data
            ]
        );

        return $book;
    }

    /**
     * @param  Book $book
     * @throws \Exception
     */
    public function delete($book)
    {
        $book->delete();
    }
}
