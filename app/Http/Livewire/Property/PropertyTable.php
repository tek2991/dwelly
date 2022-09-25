<?php

namespace App\Http\Livewire\Property;

use App\Models\Property;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class PropertyTable extends PowerGridComponent
{
    use ActionButton;

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
    * @return Builder<\App\Models\Property>
    */
    public function datasource(): Builder
    {
        return Property::query();
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
            ->addColumn('code')

           /** Example of custom column using a closure **/
            ->addColumn('code_lower', function (Property $model) {
                return strtolower(e($model->code));
            })

            ->addColumn('bhk_id')
            ->addColumn('bhk_name', function (Property $model) {
                return $model->bhk->name;
            })
            ->addColumn('floor_space')
            ->addColumn('property_type_id')
            ->addColumn('property_type_name', function (Property $model) {
                return $model->propertyType->name;
            })
            ->addColumn('flooring_id')
            ->addColumn('flooring_name', function (Property $model) {
                return $model->flooring->name;
            })
            ->addColumn('furnishing_id')
            ->addColumn('furnishing_name', function (Property $model) {
                return $model->furnishing->name;
            })
            ->addColumn('floors')
            ->addColumn('total_floors')
            ->addColumn('address')
            ->addColumn('building_name')
            ->addColumn('landmark')
            ->addColumn('locality_id')
            ->addColumn('locality_name', function (Property $model) {
                return $model->locality->name;
            })
            ->addColumn('latitude')
            ->addColumn('longitude')
            ->addColumn('gmap_link', function (Property $model) {
                $href =  'https://www.google.com/maps/search/?api=1&query=' . $model->latitude . ',' . $model->longitude;
                return '<a href="' . $href . '" target="_blank" class="text-blue-600 hover:underline">Open</a>';
            })
            ->addColumn('is_promoted')
            ->addColumn('is_promoted_name', function (Property $model) {
                return $model->is_promoted ? 'Yes' : 'No';
            })
            ->addColumn('available_from_formatted', fn (Property $model) => Carbon::parse($model->available_from)->format('d/m/Y'))
            ->addColumn('created_by')
            ->addColumn('created_by_name', function (Property $model) {
                return $model->createdBy->name;
            })
            ->addColumn('created_at_formatted', fn (Property $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            ->addColumn('updated_at_formatted', fn (Property $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));
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
            Column::make('DB ID', 'id')
                ->hidden()
                ->visibleInExport(True),

            Column::make('CODE', 'code')
                ->sortable()
                ->searchable(),

            Column::make('BHK', 'bhk_name', 'bhk')
                ->sortable()
                ->searchable()
                ->makeInputSelect(\App\Models\Bhk::all(), 'name', 'bhk_id', ['live-search' => 'true']),

            Column::make('SQ Ft', 'floor_space')
                ->makeInputRange(),

            Column::make('PROPERTY TYPE', 'property_type_name', 'property_type_id')
                ->makeInputSelect(\App\Models\PropertyType::all(), 'name', 'property_type_id', ['live-search' => true]),

            Column::make('FLOORING', 'flooring_name', 'flooring_id')
                ->makeInputSelect(\App\Models\Flooring::all(), 'name', 'flooring_id', ['live-search' => true]),

            Column::make('FURNISHING', 'furnishing_name', 'furnishing_id')
                ->makeInputSelect(\App\Models\Furnishing::all(), 'name', 'furnishing_id', ['live-search' => true]),

            Column::make('FLOORS', 'floors')
                ->makeInputRange(),

            Column::make('TOTAL FLOORS', 'total_floors')
                ->makeInputRange(),

            Column::make('ADDRESS', 'address')
                ->searchable(),

            Column::make('BUILDING NAME', 'building_name')
                ->searchable(),

            Column::make('LANDMARK', 'landmark')
                ->searchable(),

            Column::make('LOCALITY', 'locality_name', 'locality_id')
                ->makeInputSelect(\App\Models\Locality::all(), 'name', 'locality_id', ['live-search' => true]),

            Column::make('MAP', 'gmap_link'),

            Column::make('GNTEE', 'is_promoted_name', 'is_promoted')
                ->sortable(),

            Column::make('AVAILABLE FROM', 'available_from_formatted', 'available_from')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

            Column::make('CREATED BY', 'created_by_name', 'created_by')
                ->hidden()
                ->visibleInExport(True),

            Column::make('CREATED AT', 'created_at_formatted', 'created_at')
                ->hidden(),

            Column::make('UPDATED AT', 'updated_at_formatted', 'updated_at')
                ->hidden(),

        ]
;
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

     /**
     * PowerGrid Property Action Buttons.
     *
     * @return array<int, Button>
     */

    /*
    public function actions(): array
    {
       return [
           Button::make('edit', 'Edit')
               ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('property.edit', ['property' => 'id']),

           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('property.destroy', ['property' => 'id'])
               ->method('delete')
        ];
    }
    */

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

     /**
     * PowerGrid Property Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($property) => $property->id === 1)
                ->hide(),
        ];
    }
    */
}
