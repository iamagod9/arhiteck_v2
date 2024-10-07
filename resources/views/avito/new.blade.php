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
            <AvitoId>{{ uniqid('ne') }}</AvitoId>
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
            <BalconyOrLoggiaMulti>{{ implode(' | ', $estate->balcony_or_loggia) }}</BalconyOrLoggiaMulti>
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
            <ViewFromWindows>{{ implode(' | ', $estate->view_from_windows) }}</ViewFromWindows>
            <PassengerElevator>{{ $estate->passenger_elevator }}</PassengerElevator>
            <FreightElevator>{{ $estate->freight_elevator }}</FreightElevator>
            <Courtyard>{{ implode(' | ', $estate->courtyard) }}</Courtyard>
            <Parking>{{ implode(' | ', $estate->parking_type) }}</Parking>
            <RoomType>{{ implode(' | ', $estate->room_type) }}</RoomType>
            <BathroomMulti>{{ implode(' | ', $estate->bathroom_type) }}</BathroomMulti>
            <SaleOptions />
            <CeilingHeight>{{ $estate->ceiling_height }}</CeilingHeight>
            <NDAdditionally>{{ implode(' | ', $estate->nd_additionally) }}</NDAdditionally>
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