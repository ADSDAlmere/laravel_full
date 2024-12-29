<?php
namespace App\Repositories;
use App\Models\Book;
use Illuminate\Database\QueryException;

/*
 Wordt normaal gesproken gebruikt om de logica van de applicatie te scheiden van de database-interactie.
 Nu is het een beetje overkill, maar het is een goede gewoonte om te volgen.
 */
class BookRepository
{
    public $model;

    public function __construct(Book $model)
    {
        $this->model = $model;
    }
    public function all()
    {
        return $this->model->all();
    }
    public function find($id)
    {
        return $this->model->find($id);
    }
    public function create(array $data)
    {
        return $this->model->create($data);
    }
    public function update($id, array $data)
    {
        $record = $this->model->find($id);
        if ($record) {
            try {
                $record->update($data);
            } catch (QueryException $e) {
                return $e->errorInfo;
            }
            // $record->update($data); // This is not working, because the author is not in the request.
            $record->fill($data);
            $record->author()->associate($data['author']); // This takes care of the author_id
            $record->save();
            $record->categories()->sync($data['categories']); // This takes care of the categories
            return $record;
        }
        return false;
    }

    public function delete($id)
    {
        $record = $this->model->find($id);
        if ($record) {
            $record->delete();
            return true;
        }
        return false;
    }
}
