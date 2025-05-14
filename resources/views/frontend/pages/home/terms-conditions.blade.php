@extends('frontend.layouts.app')

@section('title', __('Terms and Condition ' . ' | ' . $appName))

@section('page-content')
    <div class="page-header text-center" style="background-image: url('{{ asset('frontend/assets/images/page-header-bg.jpg') }}')">
        <div class="container">
            <h1 class="page-title">Terms and Condition</h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Terms and Condition</li>
            </ol>
        </div>
    </nav>

    <div class="page-content">
        <div class="container">
            <h2 class="title text-center mb-3">Terms and Conditions</h2><!-- End .title -->
            <div class="mb-4">
                <h4>1. Acceptance of Terms</h4>
                <p>By accessing or using our website, you acknowledge that you have read, understood, and agree to be bound by these Terms. If you do not agree with any part of these Terms, you may not use our website.</p>
            </div>

            <div class="mb-4">
                <h4>2. User Eligibility</h4>
                <p>You must be at least 16 years old or the legal age of majority in your jurisdiction to use our website. By using our website, you represent and warrant that you meet the eligibility requirements.</p>
            </div>

            <div class="mb-4">
                <h4>3. Account Creation</h4>
                <p>To access certain features of our website, you may need to create an account. You are responsible for maintaining the confidentiality of your account information and for all activities that occur under your account.</p>
            </div>

            <div class="mb-4">
                <h4>4. Product Information</h4>
                <p>We strive to provide accurate and up-to-date information about the products available on our website. However, we do not warrant the accuracy, completeness, or reliability of any product information. It is your responsibility to verify the accuracy of any information before making a purchase.</p>
            </div>
            <div class="mb-4">
                <h4>5. Pricing and Payments</h4>
                <p>Prices for products on our website are subject to change without notice. We make every effort to ensure accurate pricing, but errors may occur. In the event of an error, we reserve the right to cancel or refuse any orders placed at the incorrect price. Payment for products is required at the time of purchase.</p>
            </div>

            <div class="mb-4">
                <h4>6. Shipping and Delivery</h4>
                <p>We will make every effort to ensure that your order is delivered promptly and in good condition. However, we are not responsible for any delays or damages that may occur during shipping. Any delivery dates provided are estimates and not guaranteed.</p>
            </div>

            <div class="mb-4">
                <h4>7. Returns and Refunds</h4>
                <p>We have a return policy in place. Please refer to our Returns and Refunds Policy page for detailed information on how to initiate a return, eligible items, and refund processes.</p>
            </div>

            <div class="mb-4">
                <h4>8. Intellectual Property</h4>
                <p>All content on our website, including text, graphics, logos, images, and software, is the property of {{ $appName }} and protected by intellectual property laws. You may not use, reproduce, distribute, or modify any content without our prior written consent.</p>
            </div>

            <div class="mb-4">
                <h4>9. Third-Party Links</h4>
                <p>Our website may contain links to third-party websites or services that are not owned or controlled by us. We do not endorse or assume any responsibility for the content, privacy policies, or practices of any third-party websites or services.</p>
            </div>

            <div class="mb-4">
                <h4>10. Limitation of Liability</h4>
                <p>To the maximum extent permitted by law, we shall not be liable for any direct, indirect, incidental, consequential, or punitive damages arising out of or related to your use of our website or the products purchased through our website.</p>
            </div>
            <div class="mb-4">
                <h4>11. Indemnification</h4>
                <p>You agree to indemnify and hold harmless {{ $appName }} and its affiliates, officers, directors, employees, and agents from any claims, losses, damages, liabilities, costs, or expenses arising out of your use of our website or any violation of these Terms.</p>
            </div>

            <div class="mb-4">
                <h4>12. Modifications to Terms</h4>
                <p>We reserve the right to modify or update these Terms at any time. Any changes will be effective immediately upon posting on our website. Your continued use of our website after the changes have been posted constitutes your acceptance of the modified Terms.</p>
            </div>

            <div class="mb-4">
                <h4>13. Severability</h4>
                <p>If any provision of these Terms is found to be unenforceable or invalid, the remaining provisions shall continue to be in full force and effect. The unenforceable or invalid provision shall be replaced with a valid and enforceable provision that closely matches the intent of the original provision.</p>
            </div>

            <div class="mb-4">
                <h4>14. Entire Agreement</h4>
                <p>These Terms constitute the entire agreement between you and {{ $appName }} regarding the use of our website and supersede any prior or contemporaneous agreements, communications, and proposals, whether oral or written, between you and us.</p>
            </div>

            <div class="mb-4">
                <h4>15. Assignment</h4>
                <p>You may not assign or transfer any rights or obligations under these Terms without our prior written consent. We may freely assign or transfer these Terms without restriction.</p>
            </div>

            <div class="mb-4">
                <h4>16. Language</h4>
                <p>These Terms may be provided in multiple languages for your convenience. In case of any discrepancy or inconsistency between the different language versions, the English version shall prevail.</p>
            </div>

            <div>
                <p>
                    By using our website, you acknowledge that you have read, understood, and agreed to these Terms and Conditions. If you do not agree with any part of these Terms, please refrain from using our website.

                    These Terms and Conditions were last updated on July 1 2023.
                </p>
            </div>
        </div>
    </div>

@endsection
