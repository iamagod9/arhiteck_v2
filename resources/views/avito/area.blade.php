<Ads formatVersion="3" target="Avito.ru">
  @foreach($estates as $estate)
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
    <AvitoId>{{uniqid('ae')}}</AvitoId>
    <ManagerName>{{$estate->user->name}}</ManagerName>
    <ContactPhone>{{$estate->contact_phone}}</ContactPhone>
    <Address>{{$estate->address}}</Address>
    <Longitude />
    <Latitude />
    <ContactMethod>{{$estate->contact_method}}</ContactMethod>
    <Category>{{$estate->category}}</Category>
    <Price>{{$estate->price}}</Price>
    <InternetCalls />
    <CallsDevices />
    <VideoFileURL>{{ asset('storage/' . $estate->video_url) }}</VideoFileURL>
    <OperationType>{{$estate->operation_type}}</OperationType>
    <PropertyRights>{{$estate->property_rights}}</PropertyRights>
    <LandArea>{{$estate->square}}</LandArea>
    <ObjectType>{{$estate->object_type}}</ObjectType>
    <AuctionPriceLastDate />
    <AuctionPrice />
    </Ad>
  @endforeach
</Ads>