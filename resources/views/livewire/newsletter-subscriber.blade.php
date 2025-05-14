<div class="cta-wrapper text-center">
    <h3 class="cta-title">Get the Latest Deals</h3><!-- End .cta-title -->
    <p class="cta-desc">and <br>receive <span class="text-primary">10% discount</span> for
        first shopping</p><!-- End .cta-desc -->

    <form wire:submit.prevent="subscribe">
        <div class="input-group">
            <input type="email" class="form-control" wire:model="email"
                   placeholder="Enter your Email Address"
                   aria-label="Email Address" required>

            <div class="input-group-append">
                <button class="btn btn-primary btn-rounded" type="submit"><i
                        class="icon-long-arrow-right"></i></button>
            </div>
        </div>
        @error('email') <span class="error text-danger">{{ $message }}</span> @enderror
    </form>
</div>
