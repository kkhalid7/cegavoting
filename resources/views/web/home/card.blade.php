<div class="row mb-2">
    @foreach($category->nominees as $nominee)
        <div class="col-md-6">
            <div class="nominee card flex-row mb-4 h-md-250 elevation-2" data-nominee="{{$nominee->id}}" data-category="{{$category->id}}">
                <div class="card-body d-flex flex-column align-items-start">
                    <h4
                        class="d-inline-block mb-2 text-primary mr-2 ">{{$nominee->name}}</h4>
                    <h6 class="mb-0">
                        <a class="text-muted" href="#">{{$nominee->designation}}</a>
                    </h6>
                    <h5 class="mb-0 mt-2">
                        <button class="btn btn-info bg-gradient-lightblue card-text mb-auto ml-0"
                                data-text="{{$nominee->manifesto}}" id="manifesto">Manifesto
                        </button>
                    </h5>
                </div>
                <img class="card-img-right flex-auto"
                     src="{{empty($nominee->avatar)?asset('images/Avatars.png'):$nominee->avatar->url}}"
                     alt="Card image cap" style="width: 25%;">
                    <input type="radio" name="casts[{{$category->name}}]"
                           class="mt-2 mr-3 card-radio"
                           style="width: 32px;cursor: pointer;" value="{{$nominee->id}}" id="radio-{{$category->id}}-{{$nominee->id}}"/>
            </div>
        </div>
    @endforeach
</div>
