<div class="row" wire:ignore>
    <div class="col-md-12">
        <div class="accordion" id="accordion-1">
            <div class="card">
                <div class="card-header" id="heading-1">
                    <h2 class="card-title">
                        <a role="button" data-toggle="collapse" href="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
                            Address.
                        </a>
                    </h2>
                </div><!-- End .card-header -->
                <div id="collapse-1" class="collapse show" aria-labelledby="heading-1" data-parent="#accordion-1">
                    <form wire:submit.prevent="submit">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>First Name *</label>
                                    <input type="text" class="form-control" wire:model="first_name" required>
                                    @error('first_name') <span class="error">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-sm-6">
                                    <label>Last Name *</label>
                                    <input type="text" class="form-control" wire:model="last_name" required required>
                                </div><!-- End .col-sm-6 -->
                            </div>

                            <label>Country *</label>
                            <input type="text" class="form-control" wire:model="country" disabled required>

                            <label>Street address *</label>
                            <input type="text" class="form-control" wire:model="address" placeholder="House number and Street name" required>
                            <input type="text" class="form-control" wire:model="address2" placeholder="Appartments, suite, unit etc ...">

                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Town / City *</label>
                                    <input type="text" class="form-control" wire:model="city" required>
                                </div><!-- End .col-sm-6 -->

                            </div><!-- End .row -->

                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Postcode / ZIP *</label>
                                    <input type="text" class="form-control" wire:model="zip_code" required>
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-6">
                                    <label>Phone *</label>
                                    <input type="tel" class="form-control" wire:model="phone" required>
                                </div><!-- End .col-sm-6 -->
                            </div><!-- End .row -->

                            <label>Email address *</label>
                            <input type="email" class="form-control" wire:model="email" required>

<!--                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" wire:model="is_default" id="checkout-diff-address">
                                <label class="custom-control-label" for="checkout-diff-address">Is default?</label>
                            </div>-->

                            <div class="form-footer">
                                <button type="submit" class="btn btn-outline-primary-2">SAVE CHANGES</button>
                            </div>
                        </div>
                    </form>
                </div><!-- End .collapse -->
            </div><!-- End .card -->
        </div><!-- End .accordion -->
    </div><!-- End .col-md-6 -->
</div>
