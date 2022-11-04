<?php

namespace App\Http\Livewire;

use App\Models\Tenant;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class TenantTable extends PowerGridComponent
{
    use ActionButton;

    public $property_id;
    public string $sortField = 'id';
    public string $sortDirection = 'desc';

    public function __construct($property_id)
    {
        $this->property_id = $property_id;
    }

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\Tenant>
     */
    public function datasource(): Builder
    {
        $query = Tenant::query();
        if ($this->property_id) {
            $query->where('property_id', $this->property_id);
        }
        return $query->join('users', 'users.id', '=', 'tenants.user_id')
            ->join('properties', 'properties.id', '=', 'tenants.property_id')
            ->select('tenants.*', 'users.name', 'users.email', 'users.phone_1', 'users.phone_2', 'properties.code as property_code')
            ->with('user', 'property');
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [
            'user' => ['name', 'email', 'phone_1', 'phone_2'],
            'property' => ['code'],
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('user_id')
            ->addColumn('property_id')
            ->addColumn('onboarded_at_formatted', fn (Tenant $model) => $model->onboarded_at ? Carbon::parse($model->onboarded_at)->format('d/m/Y') : 'N/A')
            ->addColumn('moved_in_at_formatted', fn (Tenant $model) => $model->moved_in_at ? Carbon::parse($model->moved_in_at)->format('d/m/Y') : 'N/A')
            ->addColumn('moved_out_at_formatted', fn (Tenant $model) => $model->moved_out_at ? Carbon::parse($model->moved_out_at)->format('d/m/Y') : 'N/A')
            ->addColumn('created_at_formatted', fn (Tenant $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            ->addColumn('updated_at_formatted', fn (Tenant $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'))
            ->addColumn('name')
            ->addColumn('email')
            ->addColumn('phone_1')
            ->addColumn('phone_2')
            ->addColumn('property_code')
            ->addColumn('property_code_link', function(Tenant $model){
                $link = route('property.show', $model->property_id);
                return "<a href='{$link}' class='text-blue-700 hover:underline'>{$model->property_code}</a>";
            });
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::make('USER ', 'name')
            ->searchable(),

        Column::make('PROPERTY', 'property_code_link', 'property_code')
            ->searchable()
            ->sortable(),

        Column::make('EMAIL', 'email')
            ->searchable()
            ->sortable(),

        Column::make('PHONE', 'phone_1')
            ->searchable()
            ->sortable(),

        Column::make('PHONE 2', 'phone_2')
            ->searchable()
            ->sortable(),

        Column::make('ONBOARDED AT', 'onboarded_at_formatted', 'onboarded_at')
            ->sortable()
            ->makeInputDatePicker(),

        Column::make('MOVED IN AT', 'moved_in_at_formatted', 'moved_in_at')
            ->sortable()
            ->makeInputDatePicker(),

        Column::make('MOVED OUT AT', 'moved_out_at_formatted', 'moved_out_at')
            ->sortable()
            ->makeInputDatePicker(),

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid Tenant Action Buttons.
     *
     * @return array<int, Button>
     */

    public function actions(): array
    {
        return [
            Button::make('show', 'Show')
            ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
            ->route('tenant.show', ['tenant' => 'id']),
            
            /*
           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('tenant.destroy', ['tenant' => 'id'])
               ->method('delete')
               */
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid Tenant Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($tenant) => $tenant->id === 1)
                ->hide(),
        ];
    }
    */
}
