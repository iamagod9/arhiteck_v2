<Ads formatVersion="3" target="Avito.ru">
  @foreach($estates as $estate)
    <Ad>
    <Id>{{$estate->id}}</Id>
    <DateBegin>{{$estate->date_begin}}</DateBegin>
    <DateEnd>{{$estate->date_end}}</DateEnd>
    <ListingFee>{{$estate->listing_fee}}</ListingFee>
    <AdStatus>{{$estate->ad_status}}</AdStatus>
    <AvitoId>{{rand(1000, 99999)}}</AvitoId>
    <ManagerName>{{$estate->user->name}}</ManagerName>
    <ContactPhone>{{$estate->contact_phone}}</ContactPhone>
    <Description>{{$estate->description}}</Description>
    <Images>
      @foreach($estate->images[0]->url as $image)
      <Image url="{{ asset('storage/' . $image) }}" />
    @endforeach
    </Images>
    <VideoURL />
    <Address>{{$estate->address}}</Address>
    <Latitude />
    <Longitude />
    <ContactMethod>{{$estate->contact_method}}</ContactMethod>
    <Category>{{$estate->category}}</Category>
    <Price>{{$estate->price}}</Price>
    <InternetCalls />
    <CallsDevices />
    <OperationType>{{$estate->operation_type}}</OperationType>
    <SafeDemonstration />
    @foreach($estate->balcony_or_loggia as $balcony_or_loggia)
    <BalconyOrLoggiaMulti>
      {{$balcony_or_loggia}}
    </BalconyOrLoggiaMulti>
  @endforeach
    @foreach($estate->lease_appliances as $lease_appliances)
    <LeaseAppliances>
      {{$lease_appliances}}
    </LeaseAppliances>
  @endforeach
    <VideoFileURL>{{ asset('storage/' . $estate->video_url) }}</VideoFileURL>
    <MarketType>{{$estate->market_type}}</MarketType>
    <HouseType>{{$estate->house_type}}</HouseType>
    <Floor>{{$estate->floor}}</Floor>
    <Floors>{{$estate->floors}}</Floors>
    <Rooms>{{$estate->rooms}}</Rooms>
    <Square>{{$estate->square}}</Square>
    <KitchenSpace>{{$estate->kitchen_space}}</KitchenSpace>
    <LivingSpace>{{$estate->living_space}}</LivingSpace>
    <ApartmentNumber>{{$estate->apartment_number}}</ApartmentNumber>
    <Status>{{$estate->status}}</Status>
    @foreach ($estate->view_from_windows as $view_from_windows)
    <ViewFromWindows>
      {{$view_from_windows}}
    </ViewFromWindows>
  @endforeach
    <PassengerElevator>{{$estate->passenger_elevator}}</PassengerElevator>
    <FreightElevator>{{$estate->freight_elevator}}</FreightElevator>
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
    <RoomType>{{$room_type}}</RoomType>
    <Renovation>{{$estate->renovation}}</Renovation>
    <BathroomMulti>{{$estate->bathroom_type}}</BathroomMulti>
    <SaleOptions />
    <CeilingHeight>{{$estate->ceiling_height}}</CeilingHeight>
    @foreach ($estate->nd_additionally as $nd_additionally)
    <NDAdditionally>
      {{$nd_additionally}}
    </NDAdditionally>
  @endforeach
    <PropertyRights>{{$estate->property_rights}}</PropertyRights>
    <RepairAdditionally>{{$estate->repair_additionally}}</RepairAdditionally>
    <RenovationProgram />
    @foreach ($estate->in_house as $in_house)
    <InHouse>
      {{$in_house}}
    </InHouse>
  @endforeach
    @foreach ($estate->ss_additionally as $ss_additionally)
    <SSAdditionally>
      {{$ss_additionally}}
    </SSAdditionally>
  @endforeach
    <DealType>{{$estate->deal_type}}</DealType>
    @foreach ($estate->furniture as $furniture)
    <Furniture>
      {{$furniture}}
    </Furniture>
  @endforeach
    <BuiltYear>{{$estate->built_year}}</BuiltYear>
    <PhotoSuggestByHouse />
    <EgrnExtractionLink />
    <AuctionPriceLastDate />
    <AuctionPrice />
    </Ad>
  @endforeach
</Ads>