<div class="p-6 2xl:p-8 rounded-[20px] bg-card">
    <h3 class="mb-6 text-md 2xl:text-lg font-bold">Способ доставки</h3>
    <div class="space-y-5">
        @foreach($deliveries as $delivery)
            <div class="space-y-3">
                <div class="form-radio">
                    <input type="radio"
                           name="delivery"
                           id="delivery-type-{{ $delivery->id }}"
                           value="{{ $delivery->id }}"
                        @checked($loop->first || old('delivery') == $delivery->id )>
                    <label for="delivery-type-{{ $delivery->id }}" class="form-radio-label">
                        {{ $delivery->title }}
                    </label>
                </div>
            </div>

            @if($delivery->with_address)
                <x-forms.text-input placeholder="Город"
                                    name="customer[city]"
                                    :is-error="$errors->has('customer.city')"
                                    value="{{ old('customer.city') }}"
                >
                </x-forms.text-input>
                @error('customer.city')
                <x-forms.error>
                    {{$message}}
                </x-forms.error>
                @enderror

                <x-forms.text-input placeholder="Адрес"
                                    name="customer[address]"
                                    :is-error="$errors->has('customer.address')"
                                    value="{{ old('customer.address') }}"
                >
                </x-forms.text-input>
                @error('customer.address')
                <x-forms.error>
                    {{$message}}
                </x-forms.error>
                @enderror
    </div>
    @endif
    @endforeach
</div>