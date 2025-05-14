<div wire:ignore class="tab-pane fade" id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">
    <div class="reviews">
        <h3>Reviews ({{ count($reviews) }})</h3>
        @foreach($reviews as $key => $review)
            <div class="review">
                <div class="row no-gutters">
                    <div class="col-auto">
                        <h4><a href="#">{{ $review->customer->first_name }}</a></h4>
                        <div class="ratings-container">
                            <div class="ratings">
                                <div class="ratings-val" style="width: {{ 20*$review->rating }}%;"></div>
                            </div><!-- End .ratings -->
                        </div><!-- End .rating-container -->
                        <span class="review-date">{{ \Carbon\Carbon::parse($review->created_at)->diffForHumans() }}</span>
                    </div><!-- End .col -->
                    <div class="col">
                        <h4>{{ $review->title }}</h4>

                        <div class="review-content">
                            <p>{{ $review->description }}</p>
                        </div><!-- End .review-content -->

<!--                        <div class="review-action">
                            <a href="#"><i class="icon-thumbs-up"></i>Helpful (2)</a>
                            <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                        </div>-->
                    </div><!-- End .col-auto -->
                </div><!-- End .row -->
            </div>
        @endforeach
    </div>
    <div class="mt-2">
        <h5>Write Your Own Review</h5>
        @if(!auth()->check())
            <p class="mb-2">Only registered users can write reviews. Please
                <a href="{{ route('frontend.auth.login') }}">Sign in</a>
            </p>
        @else
            <form wire:submit.prevent="saveReview">
                <div class="input-group">
                    <input type="text" wire:model="title" class="form-control" placeholder="Enter Title" aria-label="Enter review title" required>
                    @error('title') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="input-group mt-2">
                    <textarea wire:model="description" class="form-control" cols="30" rows="4" placeholder="Write your review here" required></textarea>
                    @error('description') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="input-group mt-2">
                    <input type="number" class="form-control" id="rating" name="rating" min="0" max="5" step="1" wire:model="rating" required>
                </div>

                <div class="mt-2">
                    <button class="btn btn-primary btn-rounded" type="submit"><span>Submit</span><i class="icon-long-arrow-right"></i></button>
                </div>
            </form>
        @endif
    </div>
</div>
