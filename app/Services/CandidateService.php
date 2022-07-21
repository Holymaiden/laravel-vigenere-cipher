<?php

namespace App\Services;

use App\Repositories\Contracts\CandidateContract as CandidateRepo;
use App\Services\Contracts\CandidateContract;
use App\Traits\Uploadable;

class CandidateService implements CandidateContract
{
    use Uploadable;

    protected $contractRepo;
    protected $image_path = 'uploads/candidates';

    public function __construct(CandidateRepo $contractRepo)
    {
        $this->contractRepo = $contractRepo;
    }

    /**
     * Get Data
     */
    public function getAll()
    {
        return $this->contractRepo->index();
    }

    /**
     * Store Data
     */
    public function store($request)
    {
        $input = $request->all();
        if ($request->hasFile('image')) {
            $image = $request->file('image')->getClientOriginalName();
            $image_name = pathinfo($image, PATHINFO_FILENAME);
            $image_name = $this->uploadFile2($request->file('image'), $this->image_path, '');
            $input['image'] = $image_name;
        }
        return $this->contractRepo->store($input);
    }

    /**
     * Get Data By ID
     */
    public function show($id)
    {
        return $this->contractRepo->show($id);
    }

    /**
     * Update Data By ID
     */
    public function update($request, $id)
    {
        $input = $request->all();
        $data = $this->contractRepo->show($id);
        if (!empty($request->image) && $request->hasFile('image')) {
            $this->deleteFile2($data->image, $this->image_path);
            $image = $request->file('image')->getClientOriginalName();
            $image_name = pathinfo($image, PATHINFO_FILENAME);
            $image_name = $this->uploadFile2($request->file('image'), $this->image_path, '');
            $input['image'] = $image_name;
        } else {
            $input['image'] = $input['image_old'];
        }
        return $this->contractRepo->update($input, $id);
    }

    /**
     * Delete Data By ID
     */
    public function delete($id)
    {
        $data = $this->contractRepo->show($id);
        $this->deleteFile2($data->image, $this->image_path);
        return $this->contractRepo->delete($id);
    }

    /**
     * Get Data with Where 
     */
    public function where($column, $value)
    {
        return $this->contractRepo->where($column, $value);
    }

    /**
     * Get Data with Pagination
     */
    public function paginate($perPage = 0, $columns = array('*'))
    {
        $perPage = $perPage ?: config('constants.PAGINATION');
        return $this->contractRepo->paginate($perPage, $columns);
    }
}
