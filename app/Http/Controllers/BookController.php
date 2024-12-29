<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class BookController extends Controller
{
    // LCRUD --> List = index, Create (Read, Update) = edit + update, Delete = destroy
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $books = Book::sortable()->latest()->paginate(5);
        $categories = Category::all();
        return view('book.index', compact('books', 'categories'))
            ->with(['i', (request()->input('page', 1) - 1) * 5, 'message' => 'Boeken zijn opgehaald.']
        );
    }

    /**
     * Create is not used, because we use edit for both create and update.
     */

    /**
     * Store is not used, because we use update for both create and update.
     */

    /**
     * Show is not used, because we use edit for both create and update.
     */

    /**
     * Show the form for creating and editing the specified resource.
     */
    public function edit(?Book $book): View
    {
        if ($book === null) {
            $book = new Book();
        }
        $categories = Category::all();
        $authors = Author::all();
        return view('book.edit', compact('book', 'categories', 'authors'));
    }

    /**
     * Create and Update the specified resource in storage.
     */
    public function update(Request $request, Book $book): RedirectResponse
    {
        $message = '';
        try {
            $req = $request->validate([
                'title' => 'required',
                'description' => 'required',
                'ISBN' => 'required',
                'author' => 'required',
                'categories' => 'nullable',
            ]);

            $message = ($book->id === null)?'Boek is aangemaakt.':'Boek is aangepast.';

            //$book->update($req); // This is not working, because the author is not in the request.
            $book->fill($req);
            $book->author()->associate($req['author']); // This takes care of the author_id
            $book->save();
            $book->categories()->sync($req['categories']); // This takes care of the categories
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            $message = 'Er is iets fout gegaan.';
            if($errorCode == 1062){
                $message = 'Er is een dublicaat gevonden voor ISBN.';
                return  back()->with(['status' => 'error', 'message' => $message])->withErrors(['ISBN' => 'ISBN is al in gebruik'])->withInput();
            } else {
                $message = 'Er is iets fout gegaan met de dataverwerking.';
                return  back()->with(['status' => 'error', 'message' => $message])->withInput();
            }
        }
        catch (\Exception $e) {
            $message = 'Er is iets fout gegaan.'.$e->getMessage();
            return  back()->with(['status' => 'error', 'message' => $message ])->withInput();
        }
        return redirect()->route('book.index')->with(['status' => 'book-updated', 'message' => $message]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();
        return redirect()->route('book.index')
                         ->with('success', 'Boek is verwijderd.');
    }
}
