<?php
namespace App\Http\Controllers;

use App\Http\Requests\SectionsRequest;
use Illuminate\Support\Facades\Storage;

class SectionsController extends BaseController
{

    /**
     * SectionsController constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->middleware([
            'auth'
        ]);
    }

    /**
     * Display a listing of the sections.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = $this->paginateCollection($this->SectionsRepository->getAllSections(), self::PAGINATE);

        return view('sections', compact(self::viewShareVarsSections));
    }

    /**
     * Add the new section.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = $this->UsersRepository->getAllUsers();

        return view('section.add', compact(self::viewShareVarsUsers));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\SectionsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SectionsRequest $request)
    {
        if (! empty($request->input('name'))) {

            $data = $request->input();
            $data['logo'] = null;

            if ($request->hasFile('logo')) {
                if ($request->file('logo')->isValid()) {

                    $uploadedFile = $request->file('logo');
                    $filename = time() . '-' . $uploadedFile->getClientOriginalName();

                    Storage::disk('public')->putFileAs('logo/', $uploadedFile, $filename);

                    $data['logo'] = $filename;
                }
            }

            $sectionId = $this->SectionsRepository->addSection($data);

            if ($data['users'] != NULL) {
                foreach ($data['users'] as $userId) {
                    $this->UsersSectionsRelationshipsRepository->addUsersSectionRelatioship($sectionId, $userId);
                }
            }

            return redirect()->route('sections.index')->with('success', 'The New section has been added successfully');
        }
    }

    /**
     * Edit the section.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($this->SectionsRepository->getEdit($id)) {
            $users = $this->UsersRepository->getAllUsers();
            $sectionInfo = $this->SectionsRepository->getSectionBySectionId($id);
            $users = $this->addUserStatusToCollection($users, $sectionInfo->users_section);

            return view('section.edit', compact(self::viewShareVarsSectionEdit));
        } else {
            return redirect()->back()->withErrors('This section does not exist.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\SectionsRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(SectionsRequest $request, $id)
    {
        if (! empty($request->input('name'))) {

            $data = $request->input();

            if ($request->hasFile('logo')) {
                if ($request->file('logo')->isValid()) {

                    $uploadedFile = $request->file('logo');
                    $filename = time() . '-' . $uploadedFile->getClientOriginalName();

                    Storage::disk('public')->putFileAs('logo/', $uploadedFile, $filename);

                    $data['logo'] = $filename;
                }
            } else {
                $data['logo'] = $this->SectionsRepository->getCurrentLogo($id)->logo;
            }

            $this->SectionsRepository->updateSection($id, $data);

            if ($data['users'] != NULL) {
                $this->UsersSectionsRelationshipsRepository->deleteUsersSectionRelatioship($id);
                foreach ($data['users'] as $userId) {
                    $this->UsersSectionsRelationshipsRepository->addUsersSectionRelatioship($id, $userId);
                }
            }

            return redirect()->route('sections.index')->with('success', 'The New section has been updated successfully');
        }
    }

    /**
     * Remove the section.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->SectionsRepository->getEdit($id)) {
            $this->SectionsRepository->deleteSection($id);

            return redirect()->back()->with('success', 'The section has been removed successfully');
        } else {
            return redirect()->back()->withErrors('This section does not exist.');
        }
    }
}
