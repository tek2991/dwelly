<?php

namespace App\Http\Livewire\Property;

use App\Models\Property;
use Illuminate\Support\Carbon;
use App\Models\EstablishmentType;
use App\Models\NearbyEstablishment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class PropertyNearbyEstablishmentTable extends PowerGridComponent
{
    use ActionButton;

    public $property_id;

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
     * @return Builder<\App\Models\NearbyEstablishment>
     */
    public function datasource(): Builder
    {
        return NearbyEstablishment::query()
            ->where('property_id', $this->property_id)
            ->join('establishment_types', 'establishment_types.id', '=', 'nearby_establishments.establishment_type_id')
            ->select('nearby_establishments.*', 'establishment_types.name as establishment_type_name');
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
            ->addColumn('establishment_type_id')
            ->addColumn('establishment_type_name')
            ->addColumn('property_id')
            ->addColumn('description', function (NearbyEstablishment $model) {
                // Line break for long descriptions every 50 characters
                return implode('<br>', str_split($model->description, 50));
            })

            /** Example of custom column using a closure **/
            ->addColumn('description_lower', function (NearbyEstablishment $model) {
                return strtolower(e($model->description));
            })

            ->addColumn('distance_in_kms')
            ->addColumn('created_at_formatted', fn (NearbyEstablishment $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            ->addColumn('updated_at_formatted', fn (NearbyEstablishment $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));
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
            Column::make('ESTABLISHMENT TYPE', 'establishment_type_name')
                ->sortable()
                ->searchable()
                ->makeInputSelect( EstablishmentType::all(), 'name', 'establishment_type_id' ),

            Column::make('DESCRIPTION', 'description')
                ->sortable()
                ->searchable(),

            Column::make('DISTANCE IN KMS', 'distance_in_kms')
                ->sortable()
                ->searchable(),
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
     * PowerGrid NearbyEstablishment Action Buttons.
     *
     * @return array<int, Button>
     */

    public function actions(): array
    {
        return [
            Button::make('edit', 'Edit')
                ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
                ->openModal('property.edit-nearby-establishment-modal', ['property_id' => $this->property_id, 'nearby_establishment_id' => 'id']),

            Button::make('destroy', 'Delete')
                ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
                ->openModal('property.remove-nearby-establishment-modal', ['property_id' => $this->property_id, 'nearby_establishment_id' => 'id']),
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
     * PowerGrid NearbyEstablishment Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [
            Rule::button('edit')
                ->when(fn($nearby) => Auth::user()->cannot('update', $nearby->property))
                ->hide(),

            Rule::button('destroy')
                ->when(fn($nearby) => Auth::user()->cannot('delete', $nearby->property))
                ->hide(),
        ];
    }
    */
    
}
