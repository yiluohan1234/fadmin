<?php
namespace App\Http\Controllers\CrudFeatures;

trait AjaxTable
{
    /**
     * The search function that is called by the data table.
     *
     * @return  JSON Array of cells in HTML form.
     */
    public function search()
    {
        $this->crud->hasAccessOrFail('list');
        $totalRows = $filteredRows = $this->crud->count();
        // if a search term was present
        if ($this->request->input('search') && $this->request->input('search')['value']) {
            // filter the results accordingly
            $this->crud->applySearchTerm($this->request->input('search')['value']);
            // recalculate the number of filtered rows
            $filteredRows = $this->crud->count();
        }
        // start the results according to the datatables pagination
        if ($this->request->input('start')) {
            $this->crud->skip($this->request->input('start'));
        }
        // limit the number of results according to the datatables pagination
        if ($this->request->input('length')) {
            $this->crud->take($this->request->input('length'));
        }
        // overwrite any order set in the setup() method with the datatables order
        if ($this->request->input('order')) {
            $column_number = $this->request->input('order')[0]['column'];
            $column_direction = $this->request->input('order')[0]['dir'];
            $column = $this->crud->findColumnById($column_number);
            if ($column['tableColumn']) {
                // clear any past orderBy rules
                $this->crud->query->getQuery()->orders = null;
                // apply the current orderBy rules
                $this->crud->orderBy($column['name'], $column_direction);
            }
        }
        $entries = $this->crud->getEntries();
        return $this->crud->getEntriesAsJsonForDatatables($entries, $totalRows, $filteredRows);
    }
}
