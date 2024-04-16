<?php

namespace App\Http\Livewire\Property;

use App\Models\Tenant;
use App\Models\Document;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class TenantDocumentTable extends PowerGridComponent
{
    use ActionButton;

    public $tenant_id;

    public $tenant_ids = [];

    public function __construct($tenant_id)
    {
        $this->tenant_id = $tenant_id;
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
     * @return Builder<\App\Models\Document>
     */
    public function datasource(): Builder
    {
        $tenant_is_primary = Tenant::find($this->tenant_id)->is_primary;
        if($tenant_is_primary) {
            $this->tenant_ids = Tenant::where('primary_tenant_id', $this->tenant_id)->pluck('id')->toArray();
        }

        $query = Document::query()
            ->where('documentable_type', 'App\Models\Tenant');

        if($tenant_is_primary) {
            $query->whereIn('documentable_id', $this->tenant_ids);
        } else {
            $query->where('documentable_id', $this->tenant_id);
        }

        return $query->join('tenants', 'tenants.id', '=', 'documents.documentable_id')
            ->join('users', 'users.id', '=', 'tenants.user_id')
            ->join('document_types', 'document_types.id', '=', 'documents.document_type_id')
            ->select('documents.*', 'document_types.name as document_type_name', 'users.name as tenant_name', 'tenants.id as tenant_id', 'tenants.is_primary as tenant_is_primary');
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
        return [];
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
            ->addColumn('document_type_id')
            ->addColumn('document_type_name')
            ->addColumn('tenant_id')
            ->addColumn('tenant_name')
            ->addColumn('tenant_link', function ($model) {
                $link = route('tenant.show', $model->tenant_id);
                return "<a href='{$link}' class='text-blue-700 hover:underline'>{$model->tenant_name}</a>";
            })
            ->addColumn('tenant_is_primary')
            ->addColumn('tenant_is_primary_label', function ($model) {
                return $model->tenant_is_primary ? 'Yes' : 'No';
            })
            ->addColumn('file_path')

            /** Example of custom column using a closure **/
            ->addColumn('file_path_lower', function (Document $model) {
                return strtolower(e($model->file_path));
            })

            ->addColumn('created_at_formatted', fn (Document $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            ->addColumn('updated_at_formatted', fn (Document $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));
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
            Column::make('DOCUMENT', 'document_type_name', 'document_type_id')
                ->sortable(),

            Column::make('TENANT NAME', 'tenant_link', 'tenant_id')
                ->sortable(),

            Column::make('PRIMARY TENANT', 'tenant_is_primary_label', 'tenant_is_primary')
                ->sortable()
                ->makeBooleanFilter('tenant_is_primary', 'Yes', 'No'),

            Column::make('UPLOADED AT', 'created_at_formatted', 'created_at')
                ->searchable()
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
     * PowerGrid Document Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
        return [
            Button::make('download', 'Download')
                ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
                ->route('document.download', ['document' => 'id']),

            Button::make('destroy', 'Delete')
                ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
                ->openModal('property.remove-tenant-document-modal', ['document_id' => 'id']),
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
     * PowerGrid Document Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($document) => $document->id === 1)
                ->hide(),
        ];
    }
    */
}
