<Ads formatVersion="3" target="Avito.ru">
    @foreach($estates as $estate)
        <Ad>
            <Description>{{ $estate->description }}</Description>
            <Images>
                @foreach($estate->images[0]->url as $image)
                    <Image url="{{ asset('storage/' . $image) }}" />
                @endforeach
            </Images>
            <VideoURL />
            <Id>{{ $estate->id }}</Id>
            <DateBegin>{{ $estate->date_begin }}</DateBegin>
            <DateEnd>{{ $estate->date_end }}</DateEnd>
            <ListingFee>{{ $estate->listing_fee }}</ListingFee>
            <AdStatus>{{ $estate->ad_status }}</AdStatus>
            <AvitoId>{{ rand(1000, 99999) }}</AvitoId>
            <ManagerName>{{ $estate->user->name }}</ManagerName>
            <ContactPhone>{{ $estate->contact_phone }}</ContactPhone>
            <ContactMethod>{{ $estate->contact_method }}</ContactMethod>
            <Category>{{ $estate->category }}</Category>
            <Price>{{ $estate->price }}</Price>
            <ShareholderFirstName />
            <ShareholderLastName />
            <ShareholderPatronymic />
            <ShareholderINN />
            <InternetCalls />
            <CallsDevices />
            <OperationType>{{ $estate->operation_type }}</OperationType>
            @foreach ($estate->balcony_or_loggia as $balcony_or_loggia)
                <BalconyOrLoggiaMulti>
                    {{$balcony_or_loggia}}
                </BalconyOrLoggiaMulti>
            @endforeach
            <MarketType>{{ $estate->market_type }}</MarketType>
            <HouseType>{{ $estate->house_type }}</HouseType>
            <Floor>{{ $estate->floor }}</Floor>
            <Floors>{{ $estate->floors }}</Floors>
            <Rooms>{{ $estate->rooms }}</Rooms>
            <Square>{{ $estate->square }}</Square>
            <KitchenSpace>{{ $estate->kitchen_space }}</KitchenSpace>
            <LivingSpace>{{ $estate->living_space }}</LivingSpace>
            <ApartmentNumber>{{ $estate->apartment_number }}</ApartmentNumber>
            <Status>{{ $estate->status }}</Status>
            @foreach ($estate->view_from_windows as $view_from_windows)
                <ViewFromWindows>
                    {{ $view_from_windows }}
                </ViewFromWindows>
            @endforeach
            <PassengerElevator>{{ $estate->passenger_elevator }}</PassengerElevator>
            <FreightElevator>{{ $estate->freight_elevator }}</FreightElevator>
            @foreach ($estate->courtyard as $courtyard)
                <Courtyard>
                    {{$courtyard}}
                </Courtyard>
            @endforeach
            @foreach ($estate->parking_type as $parking_type)
                <Parking>
                    {{$parking_type}}
                </Parking>
            @endforeach
            <RoomType>{{$estate->room_type}}</RoomType>
            <BathroomMulti>{{ $estate->bathroom_type }}</BathroomMulti>
            <SaleOptions />
            <CeilingHeight>{{ $estate->ceiling_height }}</CeilingHeight>
            @foreach ($estate->nd_additionally as $nd_additionally)
                <NDAdditionally>{{$nd_additionally}}</NDAdditionally>
            @endforeach
            <NewDevelopmentId>{{ $estate->new_development_id }}</NewDevelopmentId>
            <DevelopmentsBuildingName />
            <PropertyRights>{{ $estate->property_rights }}</PropertyRights>
            <Decoration>{{ $estate->decoration }}</Decoration>
            <SaleMethod />
            <AuctionPriceLastDate />
            <AuctionPrice />
        </Ad>
    @endforeach
</Ads>