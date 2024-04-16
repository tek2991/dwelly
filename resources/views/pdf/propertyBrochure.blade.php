<div>
    <h2 class="center-align">
        {{ $property->bhk->name . ' ' . $property->getNoOfRooms('Bathroom') . 'Bath ' . $property->propertyType->name }}
    </h2>
</div>

<!-- Main Image -->
<div style="background-image: url({{ $coverImage }});" class="main-image"></div>

<!-- Sub images -->
@foreach ($images as $image)
    <div style="background-image: url({{ $image }});" class="small-image"></div>
@endforeach

@php
    $current_date_time = date('Y-m-d H:i:s');
@endphp

<!-- Rent -->
<div>
    <h2>
        Rent: INR {{ $property->rent }}/-
    </h2>
</div>
<!-- Property details -->
<div>
    <table>
        <tr>
            <th>Description</th>
            <th>Total</th>
            <th>Description</th>
            <th>Total</th>
        </tr>
        <tr>
            <td>Bedroom</td>
            <td>{{ $property->getNoOfRooms('Bedroom') }}</td>
            <td>Bathroom</td>
            <td>{{ $property->getNoOfRooms('bathroom') }}</td>
        </tr>
        <tr>
            <td>Hall</td>
            <td>{{ $property->getNoOfRooms('Hall') }}</td>
            <td>Dining</td>
            <td>{{ $property->getNoOfRooms('Dining') }}</td>
        </tr>
        <tr>
            <td>Kitchen</td>
            <td>{{ $property->getNoOfRooms('Kitchen') }}</td>
            <td>Lobby</td>
            <td>{{ $property->getNoOfRooms('Lobby') }}</td>
        </tr>
        <tr>
            <td>Puja Room</td>
            <td>{{ $property->getNoOfRooms('Puja Room') }}</td>
            <td>Balcony</td>
            <td>{{ $property->getNoOfRooms('Balcony') }}</td>
        </tr>
        <tr>
            <td>Floor</td>
            <td>{{ $property->floors }} of {{ $property->total_floors }}</td>
            <td>Floor Space</td>
            <td>{{ $property->floor_space }} ft<sup>2</sup></td>
        </tr>
        <tr>
            <td>Flooring</td>
            <td>{{ $property->flooring->name }}</td>
            <td>Furnishing</td>
            <td>{{ $property->furnishing->name }}</td>
        </tr>
        <tr>
            <td>Rent</td>
            <td>INR {{ $property->rent }}</td>
            <td>Society Fee</td>
            <td>INR {{ $property->society_fee }}</td>
        </tr>
        <tr>
            <td>Security Deposit</td>
            <td>INR {{ $property->security_deposit }}</td>
            <td>Booking Amount</td>
            <td>INR {{ $property->booking_amount }}</td>
        </tr>
    </table>
</div>

<!-- Footer 1st page -->
<footer>
    <span class="print_date">Printed on: {{ $current_date_time }}</span>
</footer>
<!-- Page break -->
<div class="page-break"></div>

<!-- Second page -->
<div>
    <table>
        <tr>
            <th>Description</th>
            <th>Total</th>
            <th>Description</th>
            <th>Total</th>
        </tr>
        <tr>
            <td>Car Parking</td>
            <td>{{ $property->checkPropertyAminity('Parking') ? 'Yes' : 'No' }}</td>
            <td>Lift</td>
            <td>{{ $property->checkPropertyAminity('Lift') ? 'Yes' : 'No' }}</td>
        </tr>
        <tr>
            <td>Security</td>
            <td>{{ $property->checkPropertyAminity('Security') ? 'Yes' : 'No' }}</td>
            <td>Gym</td>
            <td>{{ $property->checkPropertyAminity('Gym') ? 'Yes' : 'No' }}</td>
        </tr>
        <tr>
            <td>Swimming Pool</td>
            <td>{{ $property->checkPropertyAminity('Swimming Pool') ? 'Yes' : 'No' }}</td>
            <td>Power Backup</td>
            <td>{{ $property->checkPropertyAminity('Power Backup') ? 'Yes' : 'No' }}</td>
        </tr>
        <tr>
            <td>Student friendly</td>
            <td>{{ $property->checkPropertyAminity('Student Friendly') ? 'Yes' : 'No' }}</td>
            <td>Bachelor friendly</td>
            <td>{{ $property->checkPropertyAminity('Bachelor Friendly') ? 'Yes' : 'No' }}</td>
        </tr>
        <tr>
            <td>Couples allowed</td>
            <td>{{ $property->checkPropertyAminity('Couples Friendly') ? 'Yes' : 'No' }}</td>
            <td>Family friendly</td>
            <td>{{ $property->checkPropertyAminity('Family Friendly') ? 'Yes' : 'No' }}</td>
        </tr>

    </table>
</div>

<br>

<div>
    <table class="nearby-table">
        <tr>
            <th colspan="2">Points of interests</th>
        </tr>
        @foreach ($nearbyEstablishments as $establishmentTypeId => $establishments)
            <tr>
                <td>{{ $establishments[0]->establishmentType->name }}</td>
                <td>
                    <ul>
                        @foreach ($establishments as $establishment)
                            @php
                                // Get the words before the first comma from description of the establishment
                                $description = explode(',', $establishment->description)[0];
                            @endphp
                            <li>{{ $description }}, {{ $establishment->distance_in_kms }}Km
                            </li>
                        @endforeach
                    </ul>
                </td>
            </tr>
        @endforeach
    </table>
</div>

<footer>
    <span class="print_date">Printed on: {{ $current_date_time }}</span>
</footer>



<style>
    /* Global */
    * {
        font-family: arial, sans-serif;
        color: #4f5047;
    }

    footer {
        position: absolute;
        bottom: 0px;

        font-size: .8rem;
    }

    footer .print_date {
        margin-left: 114mm;
    }

    /* Class styles */
    .center-align {
        text-align: center;
    }

    .main-image {
        padding-top: 33%;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: bottom;
        border: 2px solid gray;
        border-radius: 5px;

        margin-bottom: 2rem;
    }

    .small-image {
        width: 32.3%;
        display: inline-block;
        padding-top: 12%;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: bottom;
        border: 2px solid gray;
        border-radius: 5px;
    }

    .page-break {
        page-break-before: always;
    }

    .left {
        float: left;
    }

    .right {
        float: right;
    }

    .nearby-table li {
        list-style: none;
    }

    /* Table styles */
    table {
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>
