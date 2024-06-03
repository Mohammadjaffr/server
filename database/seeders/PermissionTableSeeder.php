<?php

namespace Database\Seeders;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions=[
            'list user',
            'add user',
            'edit user',
            'delete user',
            'list unit',
            'add unit',
            'edit unit',
            'delete unit',
            'list packing',
            'add packing',
            'edit packing',
            'delete packing',
            'list store',
            'add store',
            'edit store',
            'delete store',
            'list vendor',
            'add vendor',
            'edit vendor',
            'delete vendor',
            'list transport',
            'add transport',
            'edit transport',
            'delete transport',
            'list client',
            'add client',
            'edit client',
            'delete client',
            'list report',
            'report client',
            'report vendor',
            'report invoice',
            'list company',
            'add company',
            'edit company',
            'delete company',
            'list items',
            'add items',
            'edit items',
            'delete items',
            'list invoices',
            'add invoices_rec',
            'edit invoices_rec',
            'delete invoices_rec',
            'print invoices_rec',
            'add invoices_iss',
            'edit invoices_iss',
            'delete invoices_iss',
            'print invoices_iss',
            'archivaes',
            'add diggers',
            'delete diggers',
            'edit diggers',
            'report_invoice',

            'Setting',
            'Reportes',
            'Users',
            'People',
            'Invoices',
            'Archives section',





        ];
        foreach ($permissions as $permission){
            Permission::create(['name'=>$permission]);
        }
    }
}
