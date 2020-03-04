<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Http\Request;
use App\Repositories\UsersRepository;
use App\Repositories\SectionsRepository;
use App\Repositories\UsersSectionsRelationshipsRepository;

abstract class BaseController extends Controller
{

    /**
     * const integer
     */
    protected const PAGINATE = 5;

    /**
     * const array
     */
    protected const viewShareVarsUsers = [
        'users'
    ];

    /**
     * const array
     */
    protected const viewShareVarsSections = [
        'sections'
    ];

    /**
     * const array
     */
    protected const viewShareVarsSectionEdit = [
        'id',
        'sectionInfo',
        'users'
    ];

    /**
     * const array
     */
    protected const viewShareVarsEditUser = [
        'id',
        'userInfo'
    ];

    /**
     * BaseController constructor
     */
    public function __construct()
    {
        $this->UsersRepository = app(UsersRepository::class);
        $this->SectionsRepository = app(SectionsRepository::class);
        $this->UsersSectionsRelationshipsRepository = app(UsersSectionsRelationshipsRepository::class);
    }

    /**
     * Pagination of Illuminate\Database\Eloquent\Collection
     *
     * @param Illuminate\Database\Eloquent\Collection $collection
     * @param string|null $perPage
     * @param string|null $pageName
     * @param int|null $fragment
     *
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    protected function paginateCollection($collection, $perPage = null, $pageName = 'page', $fragment = null): Paginator
    {
        $currentPage = Paginator::resolveCurrentPage($pageName);
        $currentPageItems = $collection->slice(($currentPage - 1) * $perPage, $perPage);
        parse_str(request()->getQueryString(), $query);
        unset($query[$pageName]);
        $paginator = new Paginator($currentPageItems, $collection->count(), $perPage, $currentPage, [
            'pageName' => $pageName,
            'path' => Paginator::resolveCurrentPath(),
            'query' => $query,
            'fragment' => $fragment
        ]);

        return $paginator;
    }

    /**
     * Validate an email address.
     *
     * @param string $email
     *
     * @return boolean
     */
    protected function validEmail($email)
    {
        $atom = "[-a-z0-9!#$%&'*+/=?^_`{|}~]"; // RFC 5322 unquoted characters in local-part
        $localPart = "(?:\"(?:[ !\\x23-\\x5B\\x5D-\\x7E]*|\\\\[ -~])+\"|$atom+(?:\\.$atom+)*)"; // quoted or unquoted
        $alpha = "a-z\x80-\xFF"; // superset of IDN
        $domain = "[0-9$alpha](?:[-0-9$alpha]{0,61}[0-9$alpha])?"; // RFC 1034 one domain component
        $topDomain = "[$alpha](?:[-0-9$alpha]{0,17}[$alpha])?";

        return (bool) preg_match("(^$localPart@(?:$domain\\.)+$topDomain\\z)i", $email);
    }

    /**
     * Add the status user (exists or no exists in this section) to users collection
     *
     * @param Illuminate\Database\Eloquent\Collection $collection
     * @param Illuminate\Database\Eloquent\Collection $usersInSection
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    protected function addUserStatusToCollection($collection, $usersInSection)
    {
        foreach ($usersInSection as $user) {
            foreach ($collection as $items) {
                if ($items->id == $user->user_id) {
                    $items->is_in_section = true;
                }
            }
        }
        return $collection;
    }
}