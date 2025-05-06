<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Summary</title>
    <style>
        /* Enhanced Color Scheme and Visual Improvements */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        :root {
            --primary: #0F6D98;
            --primary-light: #0a4f5f;
            --primary-dark: #032229;
            --primary-bg: #ebf2f4;
            --secondary: #FF9600;
            --secondary-light: #ffb040;
            --secondary-dark: #e68a00;
        }

        /* Reset and base styles with enhanced colors */
        * {
            font-family: 'Inter', sans-serif !important;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: var(--primary-bg) !important;
            color: #2d3748 !important;
            background-image: 
                radial-gradient(circle, rgba(5, 54, 65, 0.03) 1px, transparent 1px) !important;
            background-size: 30px 30px !important;
            line-height: 1.5;
        }

        /* Initial Loading Animation */
        .page-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: var(--primary-bg);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            transition: opacity 0.5s ease-out, visibility 0.5s ease-out;
        }
        
        .page-loader.fade-out {
            opacity: 0;
            visibility: hidden;
        }
        
        .loader-spinner {
            position: relative;
            width: 80px;
            height: 80px;
        }
        
        .loader-spinner::before,
        .loader-spinner::after {
            content: '';
            position: absolute;
            border-radius: 50%;
        }
        
        .loader-spinner::before {
            width: 100%;
            height: 100%;
            border: 5px solid rgba(5, 54, 65, 0.1);
            border-top-color: var(--primary);
            animation: spin 1.2s linear infinite;
        }
        
        .loader-spinner::after {
            width: 50%;
            height: 50%;
            top: 25%;
            left: 25%;
            border: 4px solid transparent;
            border-bottom-color: var(--secondary);
            animation: spin-reverse 0.8s linear infinite;
        }
        
        .loader-text {
            margin-top: 20px;
            font-weight: 500;
            color: var(--primary);
            font-size: 1.1rem;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        @keyframes spin-reverse {
            to { transform: rotate(-360deg); }
        }

        /* Main container styling */
        .campspot-order-confirmation {
            max-width: 1050px;
            margin: 0 auto;
            padding: 60px 40px;
        }

        /* Header styling */
        .confirmation-heading {
            margin-bottom: 1.5rem;
        }

        .confirmation-heading-title {
            font-size: 2.5rem !important;
            font-weight: 600 !important;
            color: var(--primary) !important;
            margin-bottom: 0.5rem !important;
            border-bottom: 3px solid var(--secondary) !important;
            padding-bottom: 0.5rem !important;
            display: inline-block !important;
        }

        .order-number {
            color: #666;
            font-weight: 500;
            font-size: 1.1rem;
        }

        /* Success message styling */
        .success-message {
            background: linear-gradient(to right, rgba(255, 150, 0, 0.05), rgba(5, 54, 65, 0.05));
            border-left: 4px solid var(--secondary);
            border-radius: 12px;
            padding: 20px 25px;
            margin: 25px 0;
            box-shadow: 0 4px 12px rgba(5, 54, 65, 0.08);
        }

        .success-message p {
            margin: 8px 0;
            font-size: 1.05rem;
        }

        .success-message p:first-child {
            font-weight: 600;
            color: var(--primary);
        }

        /* Order details section */
        .order-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(5, 54, 65, 0.08);
            flex-wrap: wrap;
            position: relative;
            overflow: hidden;
        }

        .order-details::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            z-index: 1;
        }

        .campground-info, .order-info-table {
            flex: 1;
            padding: 25px;
            min-width: 300px;
        }

        .campground-info h3 {
            margin-bottom: 15px;
            margin-top: 0;
            font-size: 1.4rem;
            color: var(--primary);
            font-weight: 600;
        }

        .campground-info p {
            margin: 8px 0;
            font-size: 1rem;
            color: #4a5568;
        }

        .campground-info a {
            color: var(--primary);
            text-decoration: none;
            position: relative;
            transition: all 0.2s ease;
        }

        .campground-info a:hover {
            color: var(--secondary);
        }

        .campground-info a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--secondary);
            transition: width 0.3s ease;
        }

        .campground-info a:hover::after {
            width: 100%;
        }

        /* Order info table styling */
        .order-info-table {
            margin-left: 20px;
            margin-top: 15px;
            width: 100%;
        }

        .order-info-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid rgba(5, 54, 65, 0.08);
        }

        .order-info-label {
            font-weight: 600;
            color: var(--primary);
            flex: 1;
        }

        .order-info-value {
            flex: 2;
            text-align: right;
            color: #4a5568;
        }

        /* Order cart styling */
        .order-cart {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(5, 54, 65, 0.08);
            padding: 30px;
            position: relative;
            overflow: hidden;
        }

        .order-cart::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            z-index: 1;
        }

        .order-cart h2 {
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--secondary);
            color: var(--primary);
            position: relative;
        }

        .order-cart h2::before {
            content: '';
            display: inline-block;
            width: 18px;
            height: 18px;
            margin-right: 8px;
            background: var(--secondary);
            mask-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath d='M4 7v14h17V7H4zm8.5 10.857h-5v-1.714h5v1.714zm5 0h-2.5v-1.714h2.5v1.714zm0-3.429h-10v-1.714h10v1.714zm0-3.428h-10V9.286h10V11zM2.992 5h18v2h-18V5zm.008-2h18v2h-18V3z' fill='%23ffffff'/%3E%3C/svg%3E");
            mask-size: cover;
            -webkit-mask-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath d='M4 7v14h17V7H4zm8.5 10.857h-5v-1.714h5v1.714zm5 0h-2.5v-1.714h2.5v1.714zm0-3.429h-10v-1.714h10v1.714zm0-3.428h-10V9.286h10V11zM2.992 5h18v2h-18V5zm.008-2h18v2h-18V3z' fill='%23ffffff'/%3E%3C/svg%3E");
            -webkit-mask-size: cover;
            vertical-align: text-bottom;
        }

        /* Cart item styling */
        .cart-detail-site-item {
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 25px;
            display: flex;
            flex-wrap: wrap;
            padding: 15px;
            background-color: rgba(5, 54, 65, 0.02);
            box-shadow: 0 2px 5px rgba(5, 54, 65, 0.05);
            transition: all 0.2s ease;
        }

        .cart-detail-site-item:hover {
            box-shadow: 0 5px 15px rgba(5, 54, 65, 0.08);
            transform: translateY(-2px);
        }

        .cart-detail-site-item a {
            flex: 0 0 15%;
            margin-right: 20px;
            text-decoration: none;
        }

        .cart-detail-site-item-thumbnail {
            width: 100%;
            aspect-ratio: 1;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        }

        .cart-detail-site-item-details {
            flex: 1;
            padding: 5px 15px;
        }

        .cart-detail-site-item-name {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--primary);
        }

        .cart-detail-site-item-dates,
        .cart-detail-site-item-guests,
        .cart-detail-site-item-guests-adult,
        .cart-detail-site-item-guests-children,
        .cart-detail-site-item-guests-pet {
            font-size: 0.95rem;
            color: #4a5568;
            margin-bottom: 5px;
        }

        .cart-detail-site-item-pricing {
            flex: 0 0 30%;
            padding: 5px 15px;
        }

        .cart-detail-site-item-pricing-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .cart-detail-site-item-pricing-label {
            color: #4a5568;
        }

        .cart-detail-site-item-pricing-value,
        .cart-detail-site-order-pricing-label {
            font-weight: 600;
            text-align: right;
            color: var(--primary);
        }

        /* Order total styling */
        .order-total {
            margin-top: 30px;
            border-top: 2px solid var(--secondary);
            padding-top: 15px;
            display: flex;
            justify-content: flex-end;
        }

        .order-total .cart-detail-site-item-pricing {
            width: 30%;
            padding: 15px;
            background-color: rgba(5, 54, 65, 0.03);
            border-radius: 8px;
            position: relative;
        }

        .order-total .cart-detail-site-item-pricing::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--secondary);
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
        }

        .order-total .cart-detail-site-item-pricing-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .order-total .cart-detail-site-item-pricing-label {
            color: var(--primary);
            font-weight: 600;
        }

        .order-total .cart-detail-site-item-pricing-value {
            font-weight: 700;
            text-align: right;
            color: var(--primary);
        }

        /* Spinner and overlay styling */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(5, 54, 65, 0.7);
            backdrop-filter: blur(3px);
            z-index: 9999;
        }

        .spinner {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 60px;
            height: 60px;
        }

        .spinner:before,
        .spinner:after {
            content: '';
            position: absolute;
            border-radius: 50%;
        }

        .spinner:before {
            width: 100%;
            height: 100%;
            border: 5px solid rgba(255, 255, 255, 0.3);
            border-top-color: var(--secondary);
            animation: spin 1.2s linear infinite;
        }

        .spinner:after {
            width: 50%;
            height: 50%;
            top: 25%;
            left: 25%;
            border: 4px solid transparent;
            border-bottom-color: #ffffff;
            animation: spin-reverse 0.8s linear infinite;
        }

        /* Responsive design */
        @media (max-width: 1199px) {
            .campspot-order-confirmation {
                padding-left: 40px;
                padding-right: 40px;
            }
        }

        @media (max-width: 768px) {
            .campspot-order-confirmation {
                padding: 50px 20px;
            }

            .confirmation-heading-title {
                font-size: 1.75rem !important;
            }

            .order-details {
                flex-direction: column;
            }

            .order-info-table {
                margin-left: 0;
                padding-top: 0;
            }

            .order-info-row {
                flex-direction: column;
                align-items: flex-start;
                padding: 10px 0;
            }

            .order-info-value {
                text-align: left;
                width: 100%;
                margin-top: 4px;
            }

            .cart-detail-site-item {
                flex-direction: column;
            }

            .cart-detail-site-item a {
                flex: 0 0 100%;
                margin-right: 0;
                margin-bottom: 15px;
            }

            .cart-detail-site-item-thumbnail {
                width: 100%;
                max-height: 200px;
                object-position: center;
            }

            .cart-detail-site-item-details {
                flex: 0 0 100%;
                padding: 5px 0;
            }

            .cart-detail-site-item-pricing {
                flex: 0 0 100%;
                padding: 15px 0 0;
                margin-top: 10px;
                border-top: 1px dashed rgba(5, 54, 65, 0.1);
            }

            .order-total {
                padding-top: 15px;
                display: block;
            }

            .order-total .cart-detail-site-item-pricing {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <!-- Loading overlay -->
    <div class="page-loader">
        <div class="loader-spinner"></div>
        <div class="loader-text">Loading your booking summary...</div>
    </div>

    <!-- Content overlay for AJAX loading -->
    <div class="overlay">
        <div class="spinner"></div>
    </div>

    <div class="campspot-order-confirmation">
        <section class="confirmation-heading">
            <h1 class="confirmation-heading-title">Order Confirmation</h1>
            <p class="order-number">#000000000</p>
        </section>

        <div class="success-message">
            <p>Your order has been successfully placed!</p>
            <p>Check your email for a confirmation message with all your booking details.</p>
        </div>

        <div class="order-details">
            <div class="campground-info">
                <h3 class="campground-name">Loading Resort</h3>
                <p class="campground-address">Address: Test</p>
                <p class="campground-phone">Phone: 123456</p>
                <p class="campground-email">Email: test@email.com</p>
            </div>

            <div class="order-info-table">
                <div class="order-info-row">
                    <div class="order-info-label">Order Placed</div>
                    <div class="order-info-value guest-date">Loading</div>
                </div>
                <div class="order-info-row">
                    <div class="order-info-label">Guest Information</div>
                    <div class="order-info-value guest-name">Loading</div>
                </div>
                <div class="order-info-row">
                    <div class="order-info-label">Payment Information</div>
                    <div class="order-info-value guest-visa">Loading</div>
                </div>
                <div class="order-info-row">
                    <div class="order-info-label">Confirmation</div>
                    <div class="order-info-value guest-confirmation">Loading</div>
                </div>
                <div class="order-info-row">
                    <div class="order-info-label">Invoice</div>
                    <div class="order-info-value guest-invoice">Loading</div>
                </div>
            </div>
        </div>

        <div class="order-cart">
            <h2>Order Details</h2>
            <section class="cart-content">
                <div class="cart-summary"></div>
            </section>

            <div class="order-total">
                <div class="cart-detail-site-item-pricing">
                    <div class="cart-detail-site-item-pricing-row">
                        <span class="cart-detail-site-order-pricing-label">Order Total</span>
                        <span class="cart-detail-site-item-pricing-value order-total-value">$1,180.00</span>
                    </div>
                    <div class="cart-detail-site-item-pricing-row">
                        <span class="cart-detail-site-order-pricing-label">VISA Payment</span>
                        <span class="cart-detail-site-item-pricing-value visa-total">($1,180.00)</span>
                    </div>
                    <div class="cart-detail-site-item-pricing-row">
                        <span class="cart-detail-site-order-pricing-label">Outstanding Balance</span>
                        <span class="cart-detail-site-item-pricing-value outstanding-total">$0.00</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Add the JavaScript at the bottom of the body -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    // Show page loader
    const pageLoader = document.querySelector('.page-loader');
    const overlay = document.querySelector('.overlay');
    const spinner = document.querySelector('.spinner');
    const confirmationContent = document.querySelector('.campspot-order-confirmation');
    
    confirmationContent.style.display = 'none';

    // Function to get URL parameters
    function getParameterByName(name, url = window.location.href) {
        name = name.replace(/[\[\]]/g, '\\$&');
        const regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, ' '));
    }

    // Function to get URL parameters with localStorage fallback
    function getParameterWithFallback(paramName) {
        // First try to get from URL
        const urlParam = getParameterByName(paramName);
        
        // If URL parameter exists, use it
        if (urlParam) {
            console.log(`Found ${paramName} in URL: ${urlParam}`);
            return urlParam;
        }
        
        // Otherwise try to get from localStorage
        try {
            const storedItem = localStorage.getItem(paramName);
            if (storedItem) {
                // Check if it's stored with expiry
                try {
                    const parsedItem = JSON.parse(storedItem);
                    if (parsedItem.value) {
                        console.log(`Using ${paramName} from localStorage: ${parsedItem.value}`);
                        return parsedItem.value;
                    }
                } catch (e) {
                    // If not JSON, use the raw value
                    console.log(`Using ${paramName} from localStorage (raw): ${storedItem}`);
                    return storedItem;
                }
            }
        } catch (e) {
            console.error(`Error accessing localStorage for ${paramName}:`, e);
        }
        
        // Default fallback value
        const defaults = {
            'parkId': "92",
            'invoiceUUID': ""
        };
        
        console.warn(`${paramName} not found in URL or localStorage, using default: ${defaults[paramName]}`);
        return defaults[paramName];
    }

    // Replace the existing parameter retrieval code
    const invoiceUUID = getParameterWithFallback('invoiceUUID');
    const parkId = getParameterWithFallback('parkId');
    const environment = getParameterByName('environment') || 'campspot-staging'; // Default to 'staging' if not provided

    console.log('Park ID (final):', parkId);
    console.log('Invoice UUID (final):', invoiceUUID);
    
    // Function to adjust margin based on address length and window width
    function adjustAddressMargin() {
        var addressElement = $('.campground-address');
        if (addressElement.text().length > 45 && window.innerWidth <= 768) {
            addressElement.css('margin-bottom', '25px');
        } else {
            addressElement.css('margin-bottom', ''); // Reset margin if conditions are not met
        }
    }

    function formatDate(dateString) {
        var date = new Date(dateString);
        var options = {
            weekday: 'short',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        return date.toLocaleDateString('en-US', options);
    }

    // Check if this is the first time accessing this confirmation page for this invoice
    function isFirstTimeAccessForInvoice() {
        try {
            // Create a unique key for this specific invoice
            const visitKey = `booking_summary_visited_${invoiceUUID}`;
            
            // Check if we've already recorded a visit for this invoice
            if (localStorage.getItem(visitKey)) {
                console.log('This is a repeat visit for invoice:', invoiceUUID);
                return false;
            }
            
            // If we get here, this is the first visit, so record it
            localStorage.setItem(visitKey, new Date().toISOString());
            console.log('This is the first visit for invoice:', invoiceUUID);
            return true;
        } catch (e) {
            console.error('Error checking first visit status:', e);
            // If we can't check, default to false to prevent duplicate webhooks
            return false;
        }
    }
    
    // After document is ready
    $(document).ready(function() {
        // Delay to show the page loader animation
        setTimeout(function() {
            // Make the API call
            $.ajax({
                url: `https://insiderperks.com/wp-content/endpoints/${environment}/order-summary.php`,
                method: 'GET',
                data: {
                    parkId: "92",
                    invoiceUUID: invoiceUUID
                },
                beforeSend: function() {
                    // Show overlay spinner if AJAX takes time
                    overlay.style.display = 'block';
                    spinner.style.display = 'block';
                },
                success: function (response) {
                    console.log('API Response:', response); // Log the entire response for debugging

                    if (typeof response === 'string') {
                        try {
                            response = JSON.parse(response);
                        } catch (e) {
                            console.error('Error parsing JSON response:', e);
                            return;
                        }
                    }

                    // Assuming response is a JSON object
                    var orderSummary = response.orderSummary;
                    var parkMetadata = response.parkMetadata;
                    var campsiteConfirmationSummaries = response.orderSummary.campsiteConfirmationSummaries;

                    if (orderSummary && parkMetadata) {
                        // Check if customerName exists before using replace
                        var trimmedName = orderSummary.customerName ? 
                            orderSummary.customerName.replace(/N\/A\s*/g, '').trim() : 
                            'N/A';
                            
                        // Format phone number safely
                        var formattedPhoneNumber = parkMetadata.phoneNumber ? 
                            parkMetadata.phoneNumber.replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3') : 
                            'N/A';
                            
                        // Handle null orderDate
                        var formattedOrderDate = orderSummary.orderDate ? 
                            formatDate(orderSummary.orderDate) : 
                            'N/A';

                        // Update the HTML with the fetched data, with null checks
                        $('.order-number').text('#' + (orderSummary.invoiceId || 'N/A'));
                        $('.campground-name').text(parkMetadata.name || 'N/A');
                        $('.campground-address').text(parkMetadata.address || 'N/A');
                        $('.campground-phone').html('Phone: <a href="tel:' + (parkMetadata.phoneNumber || '') + '">' + formattedPhoneNumber + '</a>');
                        $('.campground-email').html('Email: <a href="mailto:' + (parkMetadata.email || '') + '">' + (parkMetadata.email || 'N/A') + '</a>');
                        $('.guest-date').text(formattedOrderDate);
                        $('.guest-name').text(trimmedName);
                        $('.guest-visa').text(
                            (orderSummary.cardType ? orderSummary.cardType : 'Card') + 
                            ' ending in ' + 
                            (orderSummary.lastFour || 'N/A')
                        );
                        $('.guest-confirmation').text('#' + (orderSummary.orderConfirmation || 'N/A'));
                        $('.guest-invoice').text('#' + (orderSummary.invoiceId || 'N/A'));
                        
                        // Handle arrays or null values for pricing
                        $('.order-total-value').text('$' + (Array.isArray(orderSummary.grandTotal) ? '0.00' : orderSummary.grandTotal || '0.00'));
                        
                        // Check if payments array exists and has elements
                        if (orderSummary.payments && orderSummary.payments.length > 0 && orderSummary.payments[0].total) {
                            $('.visa-total').text('($' + orderSummary.payments[0].total + ')');
                        } else {
                            $('.visa-total').text('($0.00)');
                        }
                        
                        $('.outstanding-total').text('$' + (Array.isArray(orderSummary.remainingBalance) ? '0.00' : orderSummary.remainingBalance || '0.00'));

                        // Adjust margin if address length is more than 45 characters and in mobile view
                        adjustAddressMargin();
                    } else {
                        console.error('orderSummary or parkMetadata is undefined');
                        // Show an error message to the user
                        $('.cart-summary').html('<p style="color: red; text-align: center; padding: 20px;">Unable to load booking details. Please try again later or contact support.</p>');
                    }

                    // Clear existing cart-detail-site-item elements
                    $('.cart-summary').empty();

                    // Append new cart-detail-site-item elements
                    if (campsiteConfirmationSummaries && campsiteConfirmationSummaries.length > 0) {
                        campsiteConfirmationSummaries.forEach(function (campsite) {
                            var checkinDate = new Date(campsite.checkinDateInUTC);
                            var checkoutDate = new Date(campsite.checkoutDateInUTC);
                            var totalNights = Math.ceil((checkoutDate - checkinDate) / (1000 * 60 * 60 * 24));

                            var childrenElement = campsite.childrenCount > 0 ? 
                                `<div class="cart-detail-site-item-guests-children">Children: ${campsite.childrenCount}</div>` : '';
                            var petElement = campsite.petCount > 0 ? 
                                `<div class="cart-detail-site-item-guests-pet">Pets: ${campsite.petCount}</div>` : '';

                            var cartItem = `
                                <div class="cart-detail-site-item">
                                    <a href="#">
                                        <img class="cart-detail-site-item-thumbnail" src="${campsite.images.mainImage.medium.url}" alt="${campsite.campsiteType.name}">
                                    </a>
                                    <div class="cart-detail-site-item-details">
                                        <h3 class="cart-detail-site-item-name">
                                            ${campsite.campsiteType.name} 
                                            ${campsite.campsiteType.isPetFriendly ? 
                                                '<i class="fas fa-paw" title="Pet-Friendly" role="img" aria-label="Pet-Friendly"></i>' : ''}
                                        </h3>
                                        <div>
                                            ${
                                                campsite.siteLocked === true
                                                ? `Site #${campsite.campsite.name}`
                                                : `<span style="color: #FF9600; font-size: 12px; font-weight: 500;">Site # is subject to change</span>`
                                            }
                                        </div>
                                        <div class="cart-detail-site-item-dates">${checkinDate.toDateString()} - ${checkoutDate.toDateString()}</div>
                                        <div class="cart-detail-site-item-guests-adult">Adults: ${campsite.adultCount}</div>
                                        ${childrenElement}
                                        ${petElement}
                                    </div>
                                    <div class="cart-detail-site-item-pricing">
                                        <div class="cart-detail-site-item-pricing-row">
                                            <span class="cart-detail-site-item-pricing-label">$${campsite.pricing.dailyRate.rate.toFixed(2)} x ${totalNights} Nights</span>
                                            <span class="cart-detail-site-item-pricing-value-total">$${campsite.pricing.dailyRate.total}</span>
                                        </div>
                                        <div class="cart-detail-site-item-pricing-row">
                                            <span class="cart-detail-site-item-pricing-label">Campground Fees</span>
                                            <span class="cart-detail-site-item-pricing-value-cfee">$${campsite.pricing.campgroundFeeSummary.totalCampgroundFees}</span>
                                        </div>
                                        <div class="cart-detail-site-item-pricing-row">
                                            <span class="cart-detail-site-item-pricing-label">Taxes</span>
                                            <span class="cart-detail-site-item-pricing-value-taxes">$${campsite.pricing.totalTaxes}</span>
                                        </div>
                                    </div>
                                </div>
                            `;

                            $('.cart-summary').append(cartItem);

                            if(campsite.dailyRateAddonConfirmations.length > 0) {
                                campsite.dailyRateAddonConfirmations.forEach(function (addon) {
                                    var addOncheckinDate = new Date(addon.checkinDateInUTC);
                                    var addOncheckoutDate = new Date(addon.checkoutDateInUTC);
                                    var addOntotalNights = Math.ceil((addOncheckoutDate - addOncheckinDate) / (1000 * 60 * 60 * 24));

                                    var addonItem = `
                                        <div class="cart-detail-site-item">
                                            <a href="#">
                                                <img class="cart-detail-site-item-thumbnail" src="${addon.images.mainImage.small.url}" alt="${addon.name}">
                                            </a>
                                            <div class="cart-detail-site-item-details">
                                                <h3 class="cart-detail-site-item-name">Add On: ${addon.name}</h3>
                                                <div class="cart-detail-site-item-dates">${addOncheckinDate.toDateString()} - ${addOncheckoutDate.toDateString()}</div>
                                            </div>
                                            <div class="cart-detail-site-item-pricing">
                                                <div class="cart-detail-site-item-pricing-row">
                                                    <span class="cart-detail-site-item-pricing-label">$${addon.pricing.dailyRate.rate.toFixed(2)} x ${addOntotalNights} Nights</span>
                                                    <span class="cart-detail-site-item-pricing-value-total">$${addon.pricing.dailyRate.total}</span>
                                                </div>
                                                <div class="cart-detail-site-item-pricing-row">
                                                    <span class="cart-detail-site-item-pricing-label">Campground Fees</span>
                                                    <span class="cart-detail-site-item-pricing-value-cfee">$${addon.pricing.campgroundFeeSummary.totalCampgroundFees}</span>
                                                </div>
                                                <div class="cart-detail-site-item-pricing-row">
                                                    <span class="cart-detail-site-item-pricing-label">Taxes</span>
                                                    <span class="cart-detail-site-item-pricing-value-taxes">$${addon.pricing.totalTaxes}</span>
                                                </div>
                                            </div>
                                        </div>
                                    `;

                                    $('.cart-summary').append(addonItem);
                                });
                            }

                            if(campsite.onlineStoreAddonConfirmations.length > 0) {
                                campsite.onlineStoreAddonConfirmations.forEach(function (addon) {
                                    var addOncheckinDate = new Date(addon.checkinDateInUTC);
                                    var addOncheckoutDate = new Date(addon.checkoutDateInUTC);
                                    var addOntotalNights = Math.ceil((addOncheckoutDate - addOncheckinDate) / (1000 * 60 * 60 * 24));

                                    var addonItem = `
                                        <div class="cart-detail-site-item">
                                            <a href="#">
                                                <img class="cart-detail-site-item-thumbnail" src="${addon.images.mainImage.small.url}" alt="${addon.name}">
                                            </a>
                                            <div class="cart-detail-site-item-details">
                                                <h3 class="cart-detail-site-item-name">Add On: ${addon.name}</h3>
                                                <div class="cart-detail-site-item-dates">${addOncheckinDate.toDateString()} - ${addOncheckoutDate.toDateString()}</div>
                                            </div>
                                            <div class="cart-detail-site-item-pricing">
                                                <div class="cart-detail-site-item-pricing-row">
                                                    <span class="cart-detail-site-item-pricing-label">$${addon.pricing.dailyRate.rate.toFixed(2)} x ${addOntotalNights} Nights</span>
                                                    <span class="cart-detail-site-item-pricing-value-total">$${addon.pricing.dailyRate.total}</span>
                                                </div>
                                                <div class="cart-detail-site-item-pricing-row">
                                                    <span class="cart-detail-site-item-pricing-label">Campground Fees</span>
                                                    <span class="cart-detail-site-item-pricing-value-cfee">$${addon.pricing.campgroundFeeSummary.totalCampgroundFees}</span>
                                                </div>
                                                <div class="cart-detail-site-item-pricing-row">
                                                    <span class="cart-detail-site-item-pricing-label">Taxes</span>
                                                    <span class="cart-detail-site-item-pricing-value-taxes">$${addon.pricing.totalTaxes}</span>
                                                </div>
                                            </div>
                                        </div>
                                    `;

                                    $('.cart-summary').append(addonItem);
                                });
                            }
                        });
                    } else {
                        console.error('campsiteConfirmationSummaries is undefined or empty');
                    }

                    // After processing all the data and updating the UI
                    try {
                        // Only send data to Zapier if this is the first visit
                        if (isFirstTimeAccessForInvoice()) {
                            // Get the user data we saved earlier
                            let userData = {};
                            try {
                                const savedUserData = localStorage.getItem('bookingUserData');
                                if (savedUserData) {
                                    userData = JSON.parse(savedUserData);
                                }
                            } catch (e) {
                                console.warn('Could not retrieve stored user data:', e);
                            }

                            // Prepare data for Zapier webhook
                            const zapierData = {
                                // User information
                                name: userData.name || trimmedName || 'N/A',
                                email: userData.email || 'N/A',
                                phone: userData.phone || 'N/A',
                                state: userData.state || 'N/A',
                                city: userData.city || 'N/A',
                                address: userData.address1 || 'N/A',
                                postalCode: userData.postal || 'N/A',
                                country: userData.country || 'N/A',
                                sourceLink: "rigsby",

                                // Special requests
                                smsMessage: userData.smsMessage || false,
                                sourceReferral: userData.sourceReferral || 'N/A',
                                reasonStay: userData.reasonStay || 'N/A',
                                bookingNeed: userData.bookingNeed || 'N/A',
                                
                                // Order information
                                invoiceId: orderSummary.invoiceId || 'N/A',
                                invoiceUUID: invoiceUUID || 'N/A',
                                orderConfirmation: orderSummary.orderConfirmation || 'N/A',
                                orderDate: orderSummary.orderDate || new Date().toISOString(),
                                grandTotal: orderSummary.grandTotal || '0.00',
                                remainingBalance: orderSummary.remainingBalance || '0.00',
                                
                                // Payment information
                                paymentMethod: orderSummary.cardType || 'Card',
                                lastFour: orderSummary.lastFour || 'N/A',
                                
                                // Park information
                                parkId: parkId,
                                parkName: parkMetadata.name || 'N/A',
                                parkPhone: parkMetadata.phoneNumber || 'N/A',
                                parkEmail: parkMetadata.email || 'N/A',
                                
                                // Reservation details - simplified format for first campsite
                                firstSiteType: campsiteConfirmationSummaries[0]?.campsiteType?.name || 'N/A',
                                firstSiteNumber: campsiteConfirmationSummaries[0]?.campsite?.name || 'N/A',
                                firstSiteCheckin: campsiteConfirmationSummaries[0]?.checkinDateInUTC || 'N/A',
                                firstSiteCheckout: campsiteConfirmationSummaries[0]?.checkoutDateInUTC || 'N/A',
                                
                                // Timestamp for the webhook call
                                confirmationTimestamp: new Date().toISOString()
                            };

                            // Send data using Fetch API with no-cors mode
                            fetch('https://hooks.zapier.com/hooks/catch/17158891/200vo7j/', {
                                method: 'POST',
                                mode: 'no-cors', // This prevents CORS errors but means you can't read the response
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify(zapierData)
                            })
                            .then(() => {
                                console.log('Zapier webhook request sent (no response due to no-cors)');
                            })
                            .catch(error => {
                                console.error('Error sending to Zapier:', error);
                            });
                        } else {
                            console.log('Skipping Zapier webhook - not first visit for this invoice');
                        }
                    } catch (e) {
                        console.error('Error sending data to Zapier:', e);
                    }
                },
                error: function(error) {
                    console.error('Error fetching order summary:', error);
                },
                complete: function() {
                    // Hide loading elements
                    overlay.style.display = 'none';
                    spinner.style.display = 'none';
                    
                    // Fade out the page loader
                    pageLoader.classList.add('fade-out');
                    // Show content with slight delay for smoother transition
                    setTimeout(function() {
                        confirmationContent.style.display = 'block';
                        pageLoader.style.display = 'none';
                    }, 500);
                }
            });
        }, 800); // Small delay before starting the AJAX call
    });

    // Adjust margin on window resize
    $(window).resize(function () {
        adjustAddressMargin();
    });
    </script>
</body>
</html>