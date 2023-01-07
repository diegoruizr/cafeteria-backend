<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Permission;
class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission= new Permission();
        $permission->name="Ver pagina de inicio";
        $permission->parent=null;
        $permission->action="";
        $permission->description="Permite ver la pagina de inicio";
        $permission->view="home";
        $permission->route="home";
        $permission->is_group=0;
        $permission->code="0";
        $permission->state=1;
        $permission->created_by=1;
        $permission->updated_by=null;
        $permission->save();


        /**
         * PERMISOS PARA VISTA PRODUCTO
         */
        $permission= new Permission();
        $permission->name="Gestion de Productos";
        $permission->parent=null;
        $permission->action="";
        $permission->description="Grupo de permisos de Productos";
        $permission->view="";
        $permission->route="";
        $permission->is_group=1;
        $permission->code=100;
        $permission->state=1;
        $permission->created_by=1;
        $permission->updated_by=null;
        $permission->save();
        $idAnterior = $permission->id;

        $permission= new Permission();
        $permission->name="Listar Productos";
        $permission->parent=$idAnterior;
        $permission->action="all";
        $permission->description="Permite ver los Productos";
        $permission->view="products";
        $permission->route="products";
        $permission->is_group=0;
        $permission->code=101;
        $permission->state=1;
        $permission->created_by=1;
        $permission->updated_by=null;
        $permission->save();

        $permission= new Permission();
        $permission->name="Cambiar estado Producto";
        $permission->parent=$idAnterior;
        $permission->action="state";
        $permission->description="Permite cambiar el estado del Producto";
        $permission->view="state_product";
        $permission->route="";
        $permission->is_group=0;
        $permission->code=102;
        $permission->state=1;
        $permission->created_by=1;
        $permission->updated_by=null;
        $permission->save();

        $permission= new Permission();
        $permission->name="Crear Producto";
        $permission->parent=$idAnterior;
        $permission->action="create";
        $permission->description="Permite crear una Producto";
        $permission->view="create_product";
        $permission->route="product";
        $permission->is_group=0;
        $permission->code=103;
        $permission->state=1;
        $permission->created_by=1;
        $permission->updated_by=null;
        $permission->save();

        $permission= new Permission();
        $permission->name="Modificar Producto";
        $permission->parent=$idAnterior;
        $permission->action="edit";
        $permission->description="Permite modificar una Producto";
        $permission->view="edit_product";
        $permission->route="product";
        $permission->is_group=0;
        $permission->code=104;
        $permission->state=1;
        $permission->created_by=1;
        $permission->updated_by=null;
        $permission->save();

        $permission= new Permission();
        $permission->name="Ver Producto";
        $permission->parent=$idAnterior;
        $permission->action="view";
        $permission->description="Permite ver los detalles de un Producto";
        $permission->view="view_product";
        $permission->route="product";
        $permission->is_group=0;
        $permission->code=105;
        $permission->state=1;
        $permission->created_by=1;
        $permission->updated_by=null;
        $permission->save();

        /**
         * PERMISOS PARA VISTA VENDER PRODUCTOS
         */
        $permission= new Permission();
        $permission->name="Gestion de venta";
        $permission->parent=null;
        $permission->action="";
        $permission->description="Grupo de permisos de venta de productos";
        $permission->view="";
        $permission->route="";
        $permission->is_group=1;
        $permission->code=200;
        $permission->state=1;
        $permission->created_by=1;
        $permission->updated_by=null;
        $permission->save();
        $idAnterior = $permission->id;

        $permission= new Permission();
        $permission->name="Ver vista de venta de productos";
        $permission->parent=$idAnterior;
        $permission->action="view";
        $permission->description="Permite ver los detalles de la venta de productos";
        $permission->view="view_sale";
        $permission->route="sale";
        $permission->is_group=0;
        $permission->code=201;
        $permission->state=1;
        $permission->created_by=1;
        $permission->updated_by=null;
        $permission->save();
    }
}
