@extends('frontend.layouts.app')

@section('title', __('Faq ' . ' | ' . $appName))

@section('page-content')
    <div class="page-header text-center" style="background-image: url('{{ asset('frontend/assets/images/page-header-bg.jpg') }}')">
        <div class="container">
            <h1 class="page-title">Frequently Ask Questions</h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">FAQ</li>
            </ol>
        </div>
    </nav>

    @include('admin.partials.message')
    <div class="page-content">
        <div class="container">
            <h2 class="title text-center mb-3">Shipping Information</h2><!-- End .title -->
            <div class="accordion accordion-rounded" id="accordion-1">
                <div class="card card-box card-sm bg-light">
                    <div class="card-header" id="heading-1">
                        <h2 class="card-title">
                            <a role="button" data-toggle="collapse" href="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
                                How will my parcel be delivered?
                            </a>
                        </h2>
                    </div><!-- End .card-header -->
                    <div id="collapse-1" class="collapse show" aria-labelledby="heading-1" data-parent="#accordion-1">
                        <div class="card-body">
                            <div class="faq">
                                <div class="faq-answer">
                                    <p>We partner with reputable shipping carriers to ensure that your parcel is delivered securely and efficiently. Here's an overview of our delivery process:</p>
                                    <ol>
                                        <li><strong>Shipping Methods:</strong> We offer various shipping methods to accommodate your preferences and delivery speed requirements. During the checkout process, you can select the shipping option that suits you best.</li>
                                        <li><strong>Order Processing:</strong> Once you place an order, our dedicated team promptly processes it. This includes verifying the payment, carefully packaging the items, and preparing them for shipment.</li>
                                        <li><strong>Shipping Carrier Selection:</strong> We work with trusted shipping carriers that have a track record of reliable and timely deliveries. The specific carrier assigned to your order may vary depending on factors such as your location and the size/weight of the package.</li>
                                        <li><strong>Tracking Information:</strong> As soon as your parcel is shipped, we provide you with a tracking number. This enables you to monitor the progress of your package and estimated delivery date. You can easily track your shipment through our website or by using the carrier's tracking system.</li>
                                        <li><strong>Secure Packaging:</strong> We take utmost care in packaging your items to ensure they arrive in perfect condition. Fragile or delicate products are handled with extra caution and appropriately packaged to prevent any damage during transit.</li>
                                        <li><strong>Delivery Time:</strong> The delivery time depends on the shipping method you have chosen and your location. We strive to provide accurate estimated delivery times, but please note that unforeseen circumstances such as weather conditions or peak holiday seasons may occasionally cause slight delays.</li>
                                        <li><strong>Delivery Confirmation:</strong> Once your parcel reaches its destination, a confirmation of delivery will be provided. If you have any concerns regarding the delivery or if you require assistance, our customer support team is always available to help.</li>
                                    </ol>
                                    <p>Rest assured, we are committed to ensuring a smooth and reliable delivery experience. If you have any specific questions or need further assistance regarding the delivery of your parcel, please feel free to reach out to our customer support team.</p>
                                    <p> We value your satisfaction and strive to make your shopping experience as convenient and enjoyable as possible.</p>
                                </div>
                            </div>

                        </div><!-- End .card-body -->
                    </div><!-- End .collapse -->
                </div><!-- End .card -->

                <div class="card card-box card-sm bg-light">
                    <div class="card-header" id="heading-2">
                        <h2 class="card-title">
                            <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-2" aria-expanded="false" aria-controls="collapse-2">
                                Do I pay for delivery?
                            </a>
                        </h2>
                    </div><!-- End .card-header -->
                    <div id="collapse-2" class="collapse" aria-labelledby="heading-2" data-parent="#accordion-1">
                        <div class="card-body">
                            <p>Yes, you will be charged a delivery fee. The delivery fee will be calculated based on your location and the size/weight of the package. The delivery fee will be displayed during the checkout process, prior to completing your order.</p>
                            <div class="faq">
                                <div class="faq-answer">
                                    <p>There is a delivery charge associated with your order. Our delivery charges are as follows:</p>
                                    <ul>
                                        <li>Within Dhaka City: 60 Taka</li>
                                        <li>Outside Dhaka City: 100 Taka</li>
                                    </ul>
                                    <p>Please note that we currently offer shipping services only within Bangladesh. The delivery charge helps us cover the costs associated with ensuring that your order reaches you safely and on time.</p>
                                    <p>If you have any further questions or need clarification regarding the delivery charges, please feel free to reach out to our customer support team.</p>
                                </div>
                            </div>

                        </div><!-- End .card-body -->
                    </div><!-- End .collapse -->
                </div><!-- End .card -->

                <div class="card card-box card-sm bg-light">
                    <div class="card-header" id="heading-3">
                        <h2 class="card-title">
                            <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-3" aria-expanded="false" aria-controls="collapse-3">
                                Will I be charged customs fees?
                            </a>
                        </h2>
                    </div><!-- End .card-header -->
                    <div id="collapse-3" class="collapse" aria-labelledby="heading-3" data-parent="#accordion-1">
                        <div class="card-body">
                            The customs fees are determined by the customs regulations of your country and may vary depending on the quantity and type of items you have ordered. Customs fees, import duties, and taxes are the responsibility of the customer. If you have any specific questions or concerns regarding customs fees, please contact our customer support team for further assistance.
                        </div><!-- End .card-body -->
                    </div><!-- End .collapse -->
                </div><!-- End .card -->

                <div class="card card-box card-sm bg-light">
                    <div class="card-header" id="heading-4">
                        <h2 class="card-title">
                            <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-4" aria-expanded="false" aria-controls="collapse-4">
                                My item has become faulty
                            </a>
                        </h2>
                    </div><!-- End .card-header -->
                    <div id="collapse-4" class="collapse" aria-labelledby="heading-4" data-parent="#accordion-1">
                        <div class="card-body">
                            <div class="faq">
                                <div class="faq-answer">
                                    <p>We strive to provide high-quality products, but occasionally, issues may arise. Please follow the steps below to resolve the situation:</p>
                                    <ol>
                                        <li><strong>Contact Customer Support:</strong> Reach out to our customer support team as soon as possible. Provide them with details about the faulty item, including the order number and a clear description of the issue.</li>
                                        <li><strong>Return or Exchange:</strong> Depending on the nature of the problem, our customer support team will guide you through the return or exchange process. We will work diligently to ensure a smooth and hassle-free experience.</li>
                                        <li><strong>Assessment and Resolution:</strong> Once we receive the faulty item, our team will assess it thoroughly to determine the best course of action. We may offer a repair, replacement, or refund, depending on the situation.</li>
                                        <li><strong>Timely Response:</strong> We strive to address your concerns promptly and provide a resolution in a timely manner. Our customer support team will keep you updated throughout the process.</li>
                                    </ol>
                                    <p>We value your satisfaction and aim to rectify any issues promptly. Please be assured that we will do our utmost to make things right. Thank you for your patience and understanding.</p>
                                </div>
                            </div>
                        </div><!-- End .card-body -->
                    </div><!-- End .collapse -->
                </div><!-- End .card -->
            </div><!-- End .accordion -->

            <h2 class="title text-center mb-3">Orders and Returns</h2><!-- End .title -->
            <div class="accordion accordion-rounded" id="accordion-2">
                <div class="card card-box card-sm bg-light">
                    <div class="card-header" id="heading2-1">
                        <h2 class="card-title">
                            <a class="collapsed" role="button" data-toggle="collapse" href="#collapse2-1" aria-expanded="false" aria-controls="collapse2-1">
                                Tracking my order
                            </a>
                        </h2>
                    </div><!-- End .card-header -->
                    <div id="collapse2-1" class="collapse" aria-labelledby="heading2-1" data-parent="#accordion-2">
                        <div class="card-body">
                            <div class="faq">
                                <div class="faq-answer">
                                    <p>Tracking your order is simple and convenient. Here are two ways to check your order status:</p>
                                    <ol>
                                        <li><strong>From Your Account:</strong> Log in to your account on our website and navigate to the "Orders" section. There, you will find the details of your order, including its current status. You can track the progress of your order and stay updated on its estimated delivery date.</li>
                                        <li><strong>Via Live Chat Support:</strong> If you prefer immediate assistance, you can reach out to our live chat support team. Provide them with your order number, and they will gladly provide you with the latest information regarding your order's status.</li>
                                    </ol>
                                    <p>We understand the importance of keeping track of your order, and we are committed to providing you with a smooth and transparent shopping experience. If you have any further questions or need assistance regarding your order, feel free to contact our customer support team.</p>
                                </div>
                            </div>

                        </div><!-- End .card-body -->
                    </div><!-- End .collapse -->
                </div><!-- End .card -->

                <div class="card card-box card-sm bg-light">
                    <div class="card-header" id="heading2-2">
                        <h2 class="card-title">
                            <a class="collapsed" role="button" data-toggle="collapse" href="#collapse2-2" aria-expanded="false" aria-controls="collapse2-2">
                                I haven’t received my order
                            </a>
                        </h2>
                    </div><!-- End .card-header -->
                    <div id="collapse2-2" class="collapse" aria-labelledby="heading2-2" data-parent="#accordion-2">
                        <div class="card-body">
                            <div class="faq">
                                <div class="faq-answer">
                                    <p>We understand your concerns and will assist you in resolving this matter. Please follow these steps:</p>
                                    <ol>
                                        <li><strong>Check Order Status:</strong> Log in to your account on our website and navigate to the "Orders" section. Verify the current status of your order. It may provide insight into the estimated delivery timeframe or any unexpected delays.</li>
                                        <li><strong>Delivery Timeframe:</strong> Review the estimated delivery timeframe provided during the checkout process. Keep in mind that this is an approximate timeline, and delays can occur due to unforeseen circumstances such as weather conditions or logistical challenges.</li>
                                        <li><strong>Contact Customer Support:</strong> If your order has exceeded the estimated delivery timeframe or if you have further concerns, please reach out to our customer support team. They will investigate the issue promptly and provide you with an update on your order's status.</li>
                                        <li><strong>Resolution:</strong> Our customer support team will work diligently to resolve the situation and ensure that you receive your order as soon as possible. They may provide information on the progress of your shipment, arrange a replacement, or offer a refund if necessary.</li>
                                    </ol>
                                    <p>Rest assured, we are committed to delivering a positive customer experience and will do our best to rectify the situation.</p>
                                </div>
                            </div>

                        </div><!-- End .card-body -->
                    </div><!-- End .collapse -->
                </div><!-- End .card -->

                <div class="card card-box card-sm bg-light">
                    <div class="card-header" id="heading2-3">
                        <h2 class="card-title">
                            <a class="collapsed" role="button" data-toggle="collapse" href="#collapse2-3" aria-expanded="false" aria-controls="collapse2-3">
                                How can I return an item?
                            </a>
                        </h2>
                    </div><!-- End .card-header -->
                    <div id="collapse2-3" class="collapse" aria-labelledby="heading2-3" data-parent="#accordion-2">
                        <div class="card-body">
                            <div class="faq">
                                <div class="faq-answer">
                                    <p>We understand that sometimes you may need to return an item. To initiate a return, please follow these steps:</p>
                                    <ol>
                                        <li><strong>Check Return Eligibility:</strong> Ensure that the item you wish to return is eligible for return. Certain products, such as perishable items or personalized items, may not be eligible for return due to hygiene or customization reasons.</li>
                                        <li><strong>Contact Customer Support:</strong> Reach out to our customer support team to initiate the return process. Provide them with your order details and the reason for the return. They will guide you through the necessary steps and provide you with a return authorization if applicable.</li>
                                        <li><strong>Package the Item:</strong> Safely package the item in its original packaging, including all accessories and tags. If the original packaging is not available, use suitable packaging to ensure the item is protected during transit.</li>
                                        <li><strong>Shipping the Item:</strong> Depending on your location and the nature of the item, our customer support team will provide you with instructions on how to return the item. This may include arranging a pickup from your location or providing you with a return shipping label.</li>
                                        <li><strong>Refund or Exchange:</strong> Once we receive the returned item and verify its condition, we will process your refund or exchange. The refund will be issued to your original payment method, and exchanges will be processed based on product availability.</li>
                                    </ol>
                                    <p>Please note that certain return conditions, such as the time frame for initiating a return or any applicable restocking fees, may apply. For further details or any specific questions regarding the return process, please reach out to our customer support team.</p>
                                </div>
                            </div>

                        </div><!-- End .card-body -->
                    </div><!-- End .collapse -->
                </div><!-- End .card -->
            </div><!-- End .accordion -->

            <h2 class="title text-center mb-3">Payments</h2><!-- End .title -->
            <div class="accordion accordion-rounded" id="accordion-3">
                <div class="card card-box card-sm bg-light">
                    <div class="card-header" id="heading3-1">
                        <h2 class="card-title">
                            <a class="collapsed" role="button" data-toggle="collapse" href="#collapse3-1" aria-expanded="false" aria-controls="collapse3-1">
                                What payment types can I use?
                            </a>
                        </h2>
                    </div><!-- End .card-header -->
                    <div id="collapse3-1" class="collapse" aria-labelledby="heading3-1" data-parent="#accordion-3">
                        <div class="card-body">
                            <div class="faq">
                                <div class="faq-answer">
                                    <p>Currently, we offer two payment options for your convenience:</p>
                                    <ol>
                                        <li><strong>Cash on Delivery:</strong> With this option, you can pay for your order in cash when it is delivered to your doorstep. Please ensure that you have the exact amount ready to expedite the delivery process.</li>
                                        <li><strong>Pick and Pay:</strong> This option allows you to pick up your ordered products directly from the vendor's shop. You can complete the pick and pay procedure at the shop counter and collect your items at your convenience.</li>
                                    </ol>
                                    <p>Please note that online payment options will be available soon. We are actively working to introduce secure online payment methods to provide you with more choices and flexibility.</p>
                                </div>
                            </div>
                        </div><!-- End .card-body -->
                    </div><!-- End .collapse -->
                </div><!-- End .card -->
            </div><!-- End .accordion -->
        </div><!-- End .container -->
    </div>

@endsection
