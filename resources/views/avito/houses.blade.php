<Ads formatVersion="3" target="Avito.ru">
  @foreach ($estates as $estate)
    <Ad>
    <Description>{{$estate->description}}</Description>
    <Images>
      @foreach($estate->images[0]->url as $image)
      <Image url="{{ asset('storage/' . $image) }}" />
    @endforeach
    </Images>
    <VideoURL />
    <Id>{{$estate->id}}</Id>
    <DateBegin>{{$estate->date_begin}}</DateBegin>
    <DateEnd>{{$estate->date_end}}</DateEnd>
    <ListingFee>{{$estate->listing_fee}}</ListingFee>
    <AdStatus>{{$estate->ad_status}}</AdStatus>
    <AvitoId>{{uniqid('he')}}</AvitoId>
    <ManagerName>{{$estate->user->name}}</ManagerName>
    <ContactPhone>{{$estate->contact_phone}}</ContactPhone>
    <Address>{{$estate->address}}</Address>
    <Latitude />
    <Longitude />
    <ContactMethod>{{$estate->contact_method}}</ContactMethod>
    <Category>{{$estate->category}}</Category>
    <Price>{{$estate->price}}</Price>
    <InternetCalls />
    <CallsDevices />
    <VideoFileURL>{{ asset('storage/' . $estate->video_url) }}</VideoFileURL>
    <OperationType>{{$estate->operation_type}}</OperationType>
    <SafeDemonstration />
    <LandAdditionally>{{implode(' | ', $estate->land_additionally)}}</LandAdditionally>
    <BathroomMulti>{{$estate->bathroom_type}}</BathroomMulti>
    <HouseAdditionally>{{$estate->house_additionally}}</HouseAdditionally>
    <HouseServices />
    <Electricity>{{$estate->electricity}}</Electricity>
    <GasSupply>{{$estate->gas_supply}}</GasSupply>
    <Heating>{{$estate->heating}}</Heating>
    <HeatingType>{{$estate->heating_type}}</HeatingType>
    <WaterSupply>{{$estate->water_supply}}</WaterSupply>
    <Sewerage>{{$estate->sewerage}}</Sewerage>
    <TransportAccessibility />
    <Infrastructure>{{implode(' | ', $estate->infrastructure)}}</Infrastructure>
    <ParkingType>{{$estate->parking_type}}</ParkingType>
    <Rooms>{{$estate->rooms}}</Rooms>
    <BuiltYear>{{$estate->built_year}}</BuiltYear>
    <LeaseMultimedia>{{implode(' | ', $estate->lease_multimedia)}}</LeaseMultimedia>
    <PropertyRights>{{$estate->property_rights}}</PropertyRights>
    <ObjectType>{{$estate->object_type}}</ObjectType>
    <Floors>{{$estate->floors}}</Floors>
    <WallsType>{{$estate->walls_type}}</WallsType>
    <Square>{{$estate->square}}</Square>
    <LandArea>{{$estate->land_area}}</LandArea>
    <LandStatus>{{$estate->land_status}}</LandStatus>
    <SaleOptions />
    <Renovation>{{$estate->renovation}}</Renovation>
    <AuctionPriceLastDate />
    <AuctionPrice />
    </Ad>
  @endforeach
</Ads>