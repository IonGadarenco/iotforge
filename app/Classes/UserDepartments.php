<?php

namespace App\Classes;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/**
 * Class department
 * Departamantele vizibile in CRM.
 */
class UserDepartments
{
    public static $id;
    public static $sort_order;
    public static $name;
    public static $icon;
    public static $sub_departments;
    public static $menu_departments = array();
    public static $currentDepartment;
    public static $currentSubDepartment;

    /**
     * Adaugarea unui departament nou.
     * @param $id - string, numele GET al departamentului
     * @param $name - string, numele vizibil al departamentului
     */
    public static function add_subdepartment($id, $name, $route = '')
    {
        self::$sub_departments[] = array("id" => $id, "name" => $name, 'route' => $route);
    }

    private static function clear_subdepartments()
    {
        self::$sub_departments = [];
    }

    /**
     * Inregistram departamentul in variabila globala
     * Se va folosi variabila globala $menu_departments
     */
    public static function register_department()
    {
        $department = [
            'id' => self::$id,
            'sort_order' => self::$sort_order,
            'name' => self::$name,
            'icon' => self::$icon,
            'sub_departments' => self::$sub_departments
        ];
        self::$menu_departments[] = $department;

        foreach (self::$sub_departments as $sub_department) {
            if ($sub_department['route'] && str_contains(url()->current(), $sub_department['route'])) {
                self::$currentDepartment = $department;
                self::$currentSubDepartment = $sub_department;
            }
        }
    }

    /**
     * Inregistram departamentul in variabila globala
     */
    public static function set_current()
    {
        foreach (self::$menu_departments as $department) {
            if ($department['id'] == self::$id) {
                self::$sort_order = $department['sort_order'];
                self::$name = $department['name'];
                self::$icon = $department['icon'];
                self::$sub_departments = $department['sub_departments'];
            }
        }
    }

    public static function getAllDepartments()
    {

        $sort = 0;

        self::$id = 'devices';
        self::$sort_order = ++$sort;
        self::$name = trans('Dispozitive');
        self::$icon = "far fa-list-alt";
        self::clear_subdepartments();
        self::add_subdepartment('devices', trans('link.to_devices'), route('admin.devices'));

        self::register_department();

        self::$id = 'pages';
        self::$sort_order = ++$sort;
        self::$name = trans('Pagini');
        self::$icon = "far fa-list-alt";
        self::clear_subdepartments();
        self::add_subdepartment('pages', trans('link.to_pages'), route('admin.pages'));
        self::add_subdepartment('news', trans('link.to_news'), route('admin.news'));
        self::add_subdepartment('posters', trans('link.to_banners'), route('admin.posters'));
        self::add_subdepartment('sources', trans('link.to_sources'), route('admin.sources'));
        self::register_department();

        self::$id = 'nomenclatures';
        self::$sort_order = ++$sort;
        self::$name = trans('Nomenclatoare');
        self::$icon = "far fa-list-alt";
        self::clear_subdepartments();
        self::add_subdepartment('projects', trans('link.to_projects'), route('admin.projects'));
        self::add_subdepartment('partners', trans('link.to_partners'), route('admin.partners'));
        self::add_subdepartment('persons', trans('link.to_persons'), route('admin.persons'));
        self::add_subdepartment('reports', trans('link.to_reports'), route('admin.reports'));
        self::add_subdepartment('consultations', trans('link.to_consultations'), route('admin.consultations'));
        self::add_subdepartment('lessons', trans('link.to_lessons'), route('admin.lessons'));

        self::register_department();
        // configs
        self::$id = 'configs';
        self::$sort_order = ++$sort;
        self::$name = trans('link.to_configs');
        self::$icon = "nav-main-link-icon si si-wrench";
        self::clear_subdepartments();
        self::add_subdepartment('translate', trans('link.to_constants'), route('admin.translate'));
        self::add_subdepartment('roles', trans('link.to_roles'), route('user.config.roles'));
        self::add_subdepartment('admins', trans('link.to_admins'), route('admin.config.admins'));
        self::register_department();

        return self::$menu_departments;
    }
}
