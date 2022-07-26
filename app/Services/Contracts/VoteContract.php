<?php

namespace App\Services\Contracts;

interface VoteContract
{
    public function getAll();

    public function store($request);

    public function update($update, $id);

    public function show($id);

    public function delete($id);

    public function paginate();

    public function reset();
}
