<Ads formatVersion="3" target="Avito.ru">
    @foreach($estates as $estate)
        <Ad>
            <Description>{{ $estate->description }}</Description>
            <Images>
                @foreach($estate->images as $image)
                    <Image url="{{ $image->url }}" />
                @endforeach
            </Images>
            <VideoURL></VideoURL>
            <Id></Id>
            <DateBegin></DateBegin>
            <DateEnd></DateEnd>
            <ListingFee></ListingFee>
            <AdStatus></AdStatus>
            <AvitoId></AvitoId>
            <ManagerName></ManagerName>
            <ContactPhone></ContactPhone>
            <Address></Address>
            <Latitude></Latitude>
            <Longitude></Longitude>
            <ContactMethod></ContactMethod>
            <Category></Category>
            <Price></Price>
            <InternetCalls></InternetCalls>
            <CallsDevices></CallsDevices>
            <VideoFileURL></VideoFileURL>
            <OperationType></OperationType>
            <SafeDemonstration></SafeDemonstration>
            <LandAdditionally></LandAdditionally>
            <BathroomMulti></BathroomMulti>
            <HouseAdditionally></HouseAdditionally>
            <HouseServices></HouseServices>
            <Electricity></Electricity>
            <GasSupply></GasSupply>
            <Heating></Heating>
            <HeatingType></HeatingType>
            <WaterSupply></WaterSupply>
            <Sewerage></Sewerage>
            <TransportAccessibility></TransportAccessibility>
            <Infrastructure></Infrastructure>
            <ParkingType></ParkingType>
            <Rooms></Rooms>
            <BuiltYear></BuiltYear>
            <LeaseMultimedia></LeaseMultimedia>
            <PropertyRights></PropertyRights>
            <ObjectType>{{ $estate->type }}</ObjectType>
            <Floors></Floors>
            <WallsType></WallsType>
            <Square></Square>
            <LandArea></LandArea>
            <LandStatus></LandStatus>
            <SaleOptions></SaleOptions>
            <Renovation></Renovation>
            <AuctionPriceLastDate></AuctionPriceLastDate>
            <AuctionPrice></AuctionPrice>
        </Ad>
    @endforeach
</Ads>