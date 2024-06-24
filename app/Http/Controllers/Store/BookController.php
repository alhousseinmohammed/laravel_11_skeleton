<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Store\Book;
use App\Repository\Store\BookRepository;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class BookController extends Controller
{
    /**
     * Get all the resources.
     *
     * @return mixed
     */
    public function index(Request $request)
    {

        return BookResource::collection(
            QueryBuilder::for(Book::class)
                ->allowedFilters(
                    [
                    AllowedFilter::exact('id'),
                    AllowedFilter::exact('user_id'),
                    AllowedFilter::partial('name'),
                    AllowedFilter::scope('is_published'),
                    ]
                )
                ->allowedSorts(['id'])
                ->allowedIncludes(
                    [
                    'user',
                    'store'
                    ]
                )
                ->paginate(50)
        );
    }


    /**
     * Show a resource.
     *
     * @param  Book $book
     * @return mixed
     */
    public function show(Book $book)
    {
        return BookResource::make(
            $book->load(
                [
                'store',
                'user'
                ]
            )
        );
    }

    /**
     * Create a new resource.
     *
     * @return mixed
     */
    public function create()
    {
        return BookResource::make(
            (new BookRepository())
                ->create(new Book(), request()->all())
                ->load([])
        );
    }

    /**
     * Update a resource.
     *
     * @param  Book $book
     * @return mixed
     */
    public function update(Book $book)
    {
        return BookResource::make(
            (new BookRepository())
                ->update($book, request()->all())
                ->load([])
        );
    }

    /**
     * Delete a resource.
     *
     * @param  Book $book
     * @return mixed
     * @throws \Exception
     */
    public function delete(Book $book)
    {
        $this->authorizedFor('books.delete');
        (new BookRepository())->delete($book);
    }
}
