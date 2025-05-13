<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
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
        }

        body {
            background-color: var(--primary-bg) !important;
            color: #2d3748 !important;
            background-image: 
                radial-gradient(circle, rgba(5, 54, 65, 0.03) 1px, transparent 1px) !important;
            background-size: 30px 30px !important;
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

        /* Collapse CSS */
        .collapsible-toggle {
            background: transparent;
            border: none;
            cursor: pointer;
            padding: 8px 12px !important;  /* Expands clickable area */
            min-width: 40px !important;    /* Ensures a larger hitbox */
            min-height: 40px !important;   /* Keeps a balanced size */
            margin-left: auto !important; /* Pushes arrow to the right */
            padding-left: 10px !important; /* Ensures spacing from text */
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            position: relative !important;  /* Add this for positioning context */
        }

        .arrow-icon {
            display: inline-block;
            transition: transform 0.3s ease;
            font-size: 0.75rem;
            color: var(--primary);
            width: auto;
            height: auto;
        }

        /* Increase hitbox size on mobile without changing visual appearance */
        @media (max-width: 768px) {
            .arrow-icon {
                font-size: 0.9rem !important; /* Slightly larger but not overwhelming */
                position: relative !important;
                z-index: 2 !important; /* Ensure the icon stays above the pseudo-element */
            }
            
            .collapsible-toggle {
                position: absolute !important; /* Position absolutely */
                right: 10px !important; /* Position from right edge */
                top: 0px !important; /* Move up to align with the section title text */
                height: 35px !important; /* Control the height to align with text */
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
            }
            
            /* Create an invisible larger touch target */
            .collapsible-toggle::before {
                content: '' !important;
                position: absolute !important;
                top: -15px !important;
                right: -15px !important;
                bottom: -15px !important;
                left: -15px !important;
                z-index: 1 !important; /* Under the icon but above other elements */
            }
            
            /* Make the section title accommodate the larger button */
            .checkout-form-section-title {
                padding-right: 60px !important; /* Make room for the button */
                position: relative !important; /* For absolute positioning context */
                display: flex !important;
                align-items: center !important; /* Center items vertically */
            }
        }

        .arrow-icon.expanded {
            transform: rotate(90deg);
            color: var(--secondary);
        }

        .collapsible-toggle:hover .arrow-icon {
            color: var(--secondary);
        }

        /* Disabled Fields */
        input:disabled,
        select:disabled,
        textarea:disabled {
            background-color: #f5f5f5 !important;
            color: #6c757d !important;
            cursor: not-allowed !important;
            border-color: #dee2e6 !important;
            opacity: 0.8 !important;
        }

        /* Style specifically for the guest information disabled fields */
        #guest-info-content input:disabled,
        #guest-info-content select:disabled,
        #guest-info-content textarea:disabled {
            background-color: #f2f4f6 !important;
            border-color: #e2e8f0 !important;
            color: #4a5568 !important;
            box-shadow: none !important;
        }

        /* Add a subtle pattern to disabled inputs for better visual distinction */
        #guest-info-content input:disabled,
        #guest-info-content textarea:disabled {
            background-image: linear-gradient(45deg, #f8fafc 25%, #f2f4f6 25%, #f2f4f6 50%, #f8fafc 50%, #f8fafc 75%, #f2f4f6 75%, #f2f4f6 100%) !important;
            background-size: 8px 8px !important;
        }

        /* Header styling */
        .checkout-heading-title {
            font-size: 2.5rem !important;
            font-weight: 600 !important;
            color: var(--primary) !important;
            margin-bottom: 1.5rem !important;
            border-bottom: 3px solid var(--secondary) !important;
            padding-bottom: 0.5rem !important;
            display: inline-block !important;
        }

        /* Modern form sections with enhanced visual interest */
        .checkout-form-section {
            background: #ffffff !important;
            border-radius: 12px !important;
            box-shadow: 0 4px 12px rgba(5, 54, 65, 0.08) !important;
            margin-bottom: 2rem !important;
            padding: 2rem !important;
            position: relative !important;
            border-top: 4px solid var(--primary) !important;
            transition: all 0.3s ease !important;
        }

        /* Add a subtle accent to the right side of sections */
        .checkout-form-section::after {
            content: '';
            position: absolute !important;
            top: 0 !important;
            right: 0 !important;
            height: 100% !important;
            width: 6px !important;
            background: linear-gradient(to bottom, var(--primary), transparent) !important;
            border-top-right-radius: 12px !important;
            border-bottom-right-radius: 12px !important;
            opacity: 0.3 !important;
        }

        .checkout-form-section:hover {
            box-shadow: 0 10px 20px rgba(5, 54, 65, 0.12) !important;
        }

        /* Section titles with new accent design */
        .checkout-form-section-title {
            font-size: 1.25rem !important;
            font-weight: 600 !important;
            color: var(--primary) !important;
            margin-bottom: 1.75rem !important;
            padding-bottom: 0.5rem !important;
            position: relative !important;
            border-bottom: 1px dashed rgba(5, 54, 65, 0.2) !important;
            display: flex !important;
            align-items: center !important;
        }

        .checkout-form-section-title::before {
            content: attr(data-number) !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 32px !important;
            height: 32px !important;
            background: var(--secondary) !important;
            color: white !important;
            border-radius: 50% !important;
            margin-right: 12px !important;
            font-size: 1rem !important;
            font-weight: 600 !important;
            box-shadow: 0 2px 4px rgba(255, 150, 0, 0.2) !important;
        }

        /* Modern form inputs */
        .checkout-form-field-input,
        .checkout-form-field-input-dropdown,
        textarea.checkout-form-field-input,
        .checkout-promo-code-form-field-input {
            border: 2px solid #e2e8f0 !important;
            border-radius: 8px !important;
            padding: 0.75rem 1rem !important;
            font-size: 1rem !important;
            transition: all 0.2s ease !important;
            background-color: #ffffff !important;
        }

        .checkout-form-field-input:focus,
        .checkout-form-field-input-dropdown:focus,
        textarea.checkout-form-field-input:focus,
        .checkout-promo-code-form-field-input:focus {
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 3px rgba(5, 54, 65, 0.1) !important;
            outline: none !important;
        }

        /* Improved labels */
        .checkout-form-field-label {
            font-size: 0.875rem !important;
            font-weight: 600 !important;
            color: var(--primary) !important;
            margin-bottom: 0.5rem !important;
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
        }

        /* Primary action button */
        .checkout-form-submit-button {
            background: linear-gradient(45deg, var(--primary), var(--primary-light)) !important;
            border: none !important;
            border-radius: 10px !important;
            font-size: 1.125rem !important;
            font-weight: 600 !important;
            padding: 1rem 2rem !important;
            transition: all 0.3s ease !important;
            box-shadow: 0 4px 6px rgba(5, 54, 65, 0.2) !important;
            color: #ffffff !important;
            position: relative !important;
            overflow: hidden !important;
            min-height: 60px !important;
            min-width: 250px !important;
        }

        .checkout-form-submit-button::after {
            content: '';
            position: absolute !important;
            top: 0 !important;
            left: -100% !important;
            width: 100% !important;
            height: 100% !important;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent) !important;
            transition: all 0.5s ease !important;
        }

        .checkout-form-submit-button:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 12px rgba(5, 54, 65, 0.3) !important;
            background: linear-gradient(45deg, var(--primary-light), var(--primary)) !important;
        }

        .checkout-form-submit-button:hover::after {
            left: 100% !important;
        }

        /* Enhanced summary section */
        .checkout-summary-content {
            background: #ffffff !important;
            border-radius: 12px !important;
            box-shadow: 0 4px 12px rgba(5, 54, 65, 0.08) !important;
            padding: 2rem !important;
            border-top: 4px solid var(--primary) !important;
            position: relative !important;
            overflow: visible !important;
        }

        .checkout-summary-content::before {
            content: '';
            position: absolute !important;
            top: 16px !important;
            right: 16px !important;
            width: 50px !important;
            height: 50px !important;
            background: radial-gradient(circle, rgba(5, 54, 65, 0.03) 30%, transparent 70%) !important;
            border-radius: 50% !important;
        }

        .checkout-summary-title {
            font-size: 1.25rem !important;
            font-weight: 600 !important;
            color: var(--primary) !important;
            margin-bottom: 1.5rem !important;
            padding-bottom: 0.5rem !important;
            border-bottom: 2px solid var(--secondary) !important;
        }

        /* Improved payment section styling */
        .checkout-form-payment-amount,
        .checkout-form-payment-method {
            border: 2px solid #e2e8f0 !important;
            border-radius: 12px !important;
            overflow: hidden !important;
            transition: all 0.2s ease !important;
            background-color: #ffffff !important;
        }

        .checkout-form-payment-amount.is-selected,
        .checkout-form-payment-method.is-selected {
            border-color: var(--secondary) !important;
            box-shadow: 0 0 0 2px rgba(255, 150, 0, 0.15) !important;
            background-color: rgba(255, 150, 0, 0.03) !important;
        }

        /* Enhanced promo code section */
        .checkout-promo-code-form {
            background: linear-gradient(to right, rgba(5, 54, 65, 0.02), rgba(255, 150, 0, 0.02)) !important;
            border-radius: 8px !important;
            padding: 1.5rem !important;
            border: 1px solid #e2e8f0 !important;
            margin-top: 1.5rem !important;
        }

        /* Updated links styling */
        .checkout-content a,
        .checkout-form-field-toggle, 
        .checkout-promo-code-toggle,
        .checkout-form-field-texting-toggle,
        .checkout-form-sensible-weather a {
            color: var(--primary) !important;
            text-decoration: none !important;
            border-bottom: 1px solid transparent !important;
            transition: all 0.2s ease !important;
            font-weight: 500 !important;
            position: relative !important;
            display: inline-block !important;
        }

        .checkout-content a:hover,
        .checkout-form-field-toggle:hover, 
        .checkout-promo-code-toggle:hover,
        .checkout-form-field-texting-toggle:hover,
        .checkout-form-sensible-weather a:hover {
            color: var(--secondary) !important;
            border-bottom-color: var(--secondary) !important;
        }

        /* Subtle hover indicator for links */
        .checkout-content a::after,
        .checkout-form-field-toggle::after, 
        .checkout-promo-code-toggle::after,
        .checkout-summary-policies a::after,
        .checkout-form-field-texting-detail a::after,
        .checkout-form-sensible-weather a::after {
            content: '' !important;
            position: absolute !important;
            bottom: -2px !important;
            left: 0 !important;
            width: 0 !important;
            height: 2px !important;
            background-color: var(--secondary) !important;
            transition: width 0.3s ease !important;
        }

        .checkout-content a:hover::after,
        .checkout-form-field-toggle:hover::after, 
        .checkout-promo-code-toggle:hover::after,
        .checkout-summary-policies a:hover::after,
        .checkout-form-field-texting-detail a:hover::after,
        .checkout-form-sensible-weather a:hover::after {
            width: 100% !important;
        }

        /* Enhanced checkbox and radio styling */
        input[type="checkbox"],
        input[type="radio"] {
            accent-color: var(--secondary) !important;
            cursor: pointer !important;
        }

        .checkout-form-field-checkbox {
            margin-top: 1rem !important;
        }

        /* Section dividers with gradient */
        .checkout-form-section-group + .checkout-form-section-group {
            border-top: 1px solid transparent !important;
            background-image: linear-gradient(to right, transparent, rgba(5, 54, 65, 0.15), transparent) !important;
            background-size: 100% 1px !important;
            background-position: 0 0 !important;
            background-repeat: no-repeat !important;
            padding-top: 2rem !important;
            margin-top: 2rem !important;
        }

        /* Add decorative elements to the summary */
        .checkout-summary-site {
            position: relative !important;
            margin-bottom: 24px !important;
            padding-bottom: 20px !important;
            border-bottom: 1px dashed rgba(5, 54, 65, 0.15) !important;
        }

        .checkout-summary-site::after {
            content: '';
            position: absolute !important;
            bottom: -1px !important;
            left: 50% !important;
            transform: translateX(-50%) !important;
            width: 30% !important;
            height: 3px !important;
            background: linear-gradient(to right, transparent, var(--secondary), transparent) !important;
            border-radius: 2px !important;
        }

        /* Beautify total amount display */
        .checkout-summary-totals {
            background-color: rgba(5, 54, 65, 0.03) !important;
            padding: 15px 15px 15px 18px !important;
            border-radius: 8px !important;
            margin-top: 15px !important;
            position: relative !important;
            overflow: hidden !important;
        }

        .checkout-summary-totals::before {
            content: '' !important;
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            width: 4px !important;
            height: 100% !important;
            background: var(--secondary) !important;
        }

        .checkout-summary-totals-amount {
            color: var(--primary) !important;
            font-weight: 700 !important;
            font-size: 1.15rem !important;
            padding-right: 5px !important;
        }

        /* Modal styling */
        .modal-content {
            border-radius: 12px !important;
            border: none !important;
            box-shadow: 0 10px 25px rgba(5, 54, 65, 0.15) !important;
        }

        #closeModalButton,
        #closePaymentErrorModalButton,
        #closeTermsModalButton,
        #closeCardNotReadyModalButton {
            background-color: var(--secondary) !important;
            color: white !important;
            border: none !important;
            padding: 10px 20px !important;
            border-radius: 8px !important;
            font-weight: 600 !important;
            transition: all 0.2s ease !important;
        }

        #closeModalButton:hover,
        #closePaymentErrorModalButton:hover,
        #closeTermsModalButton:hover,
        #closeCardNotReadyModalButton:hover {
            background-color: var(--secondary-dark) !important;
            transform: translateY(-1px) !important;
        }

        /* Add accent elements to the payment form */
        .checkout-form-field-cardconnect-iframe {
            border: 2px solid #e2e8f0 !important;
            border-radius: 8px !important;
            background-image: linear-gradient(to bottom, #ffffff, rgba(5, 54, 65, 0.02)) !important;
            transition: all 0.2s ease !important;
        }

        /* Make billing checkbox more prominent */
        .checkout-form-field-checkbox.mod-billing-address {
            margin: 1.5rem 0 !important;
            padding: 0.75rem 1rem !important;
            background-color: rgba(5, 54, 65, 0.03) !important;
            border-left: 3px solid var(--primary) !important;
            border-radius: 6px !important;
        }

        /* Add visual decoration to field groups */
        .checkout-form-field + .checkout-form-field {
            position: relative !important;
        }

        /* Enhance section visual cues */
        .checkout-form-section {
            position: relative !important;
        }

        /* Enhanced visual for the order summary items */
        .checkout-summary-item {
            border-radius: 8px !important;
            transition: all 0.2s ease !important;
        }

        .checkout-summary-item-title {
            color: var(--primary) !important;
        }

        .checkout-summary-item-price {
            font-weight: 700 !important;
            color: var(--primary) !important;
        }

        /* Cost External Breakdown */
        .checkout-summary-external-charges {
            margin-top: 15px !important;
            background-color: rgba(5, 54, 65, 0.03) !important;
            border-radius: 8px !important;
            padding: 12px 15px 15px !important;
            position: relative !important;
            overflow: hidden !important;
        }

        .checkout-summary-external-charges::before {
            content: '' !important;
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            width: 4px !important;
            height: 100% !important;
            background: var(--secondary) !important;
        }

        .fee-help-text {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        /* Show help text on hover */
        .checkout-summary-item-title:hover .fee-help-text {
            max-height: 200px;
            transition: max-height 0.5s ease-in;
        }

        /* Accent the cardholder form */
        #payment-expiration-date .checkout-form-field-cc-exp {
            border: 2px solid #e2e8f0 !important;
            border-radius: 8px !important;
            background: linear-gradient(to bottom, #ffffff, rgba(5, 54, 65, 0.02)) !important;
        }

        .overlay {
        display: none;
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        width: 100% !important;
        height: 100% !important;
        background: rgba(0, 0, 0, 0.5) !important;
        z-index: 1000 !important;
        }

        .spinner {
        display: none;
        position: absolute !important;
        top: 50% !important;
        left: 50% !important;
        width: 50px !important;
        height: 50px !important;
        margin-top: -25px !important;
        margin-left: -25px !important;

        border: 8px solid rgba(255, 255, 255, 0.3) !important;
        border-top: 8px solid #fff !important;
        border-radius: 50% !important;
        animation: spin 1s linear infinite !important;
        }

        /* Modal Container */
        .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);
        }

        /* Modal Content Box */
        .modal-content {
        background-color: #fff;
        margin: 10% auto;
        padding: 20px;
        border-radius: 10px;
        border: 1px solid #888;
        width: 40%;
        max-width: 400px;
        text-align: center;
        }

        /* Close Button */
        .close {
        color: #aaa;
        float: right;
        font-size: 20px;
        margin-right: 10px;
        cursor: pointer;
        }

        /* Text in Modal */
        .modal p {
        margin-top: 20px !important;
        margin-bottom: 20px !important;
        font-size: 16px;
        }

        /* OK Button */
        #closeModalButton {
        margin-top: 10px !important;
        background-color: #f44336;
        color: white;
        padding: 6px 15px !important;
        border: none;
        border-radius: 12px !important;
        cursor: pointer;
        font-size: 12px !important;
        }

        #closeModalButton:hover {
        background-color: #d32f2f;
        }

        .app-checkout-summary-site-title {
        font-size: .875rem !important;
        }

        .app-checkout-summary-site-dates,
        .app-checkout-summary-site-guests {
        font-weight: normal !important;
        font-size: .940rem !important;
        }

        .checkout-summary-item,
        .checkout-summary-item * {
            pointer-events: none !important;
        }


        .billing-form-field-toggle {
        background: 0 0 !important;
        border: none !important;
        color: var(--primary) !important;
        cursor: pointer !important;
        font-size: .8125rem !important;
        padding: 0 !important;
        text-decoration: underline !important;
        transition: color .1s ease-in-out, text-decoration-style .1s ease-in-out !important
        }

        /* .app-checkout-summary-site-guests {
        padding-bottom: 20px !important;
        } */

        .checkout-form-field-texting-detail {
        font-size: .875rem !important;
        margin-top: 10px !important;
        margin-left: calc(8px + .9375rem) !important
        }

        .checkout-form-field-texting-detail a {
        text-decoration: underline !important
        }

        .checkout-form-field-text-opt-in {
        margin-top: 10px !important;
        }

        .checkout-form-billing-address {
        border-radius: 4px !important;
        background: #f8f8f8 !important;
        margin-top: 20px !important;
        padding: 20px 20px 24px !important
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p {
        margin: 0 !important
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
        line-height: 1.25 !important
        }

        .checkout-form-billing-address-title {
        color: #767676 !important;
        font-size: 1rem !important;
        font-weight: 700 !important;
        margin-bottom: 16px !important
        }

        .checkout-form-field.mod-address-2 {
        margin-top: 10px !important
        }

        button {
        border-radius: 0 !important
        }

        [type=reset],
        [type=submit],
        button,
        html [type=button] {
        appearance: button !important
        }

        .checkout-form-field-toggle {
        background: 0 0 !important;
        border: none !important;
        color: var(--primary) !important;
        cursor: pointer !important;
        font-size: .8125rem !important;
        padding: 0 !important;
        text-decoration: underline !important;
        transition: color .1s ease-in-out, text-decoration-style .1s ease-in-out !important
        }

        button,
        select {
        text-transform: none
        }

        .checkout-form-field-input-dropdown {
        background: #f5f5f5 !important;
        border: 1px solid #bbb !important;
        border-radius: 3px !important;
        cursor: pointer !important;
        display: block !important;
        height: 2.5rem !important;
        max-width: 100% !important;
        padding: 0 12px !important
        }

        .checkout-form-field {
        display: block !important;
        max-width: 450px !important
        }

        .checkout-form-field+.checkout-form-field {
        margin-top: 16px !important
        }

        label {
        display: inline-block !important;
        margin-bottom: 0 !important
        }

        .checkout-form-field-label {
        display: block !important;
        font-size: .8125rem !important;
        font-weight: 700 !important;
        margin-bottom: 2px !important
        }

        *,
        ::after,
        ::before {
        box-sizing: border-box !important
        }

        [role=button],
        a,
        area,
        button,
        input:not([type=range]),
        label,
        select,
        summary,
        textarea {
        touch-action: manipulation !important
        }

        button,
        input,
        optgroup,
        select,
        textarea {
        margin: 0 !important;
        font-family: inherit !important;
        font-size: inherit !important;
        line-height: inherit !important
        }

        button,
        input {
        overflow: visible !important
        }

        .checkout-form-field-input {
        border: 1px solid #bbb !important;
        border-radius: 3px !important;
        display: block !important;
        min-height: 2.25rem !important;
        min-width: 0 !important;
        padding: 6px 10px !important;
        width: 100% !important
        }

        .checkout-form-field-input.mod-postal-code {
        max-width: 170px !important
        }

        .checkout-promo-code-form-field-input {
        text-transform: uppercase;
        }

        .checkout-content {
        padding-bottom: 60px !important;
        }

        .checkout-policy, .app-checkout-policy-park-terms-link, 
        .app-checkout-policy-campspot-terms-link, .app-checkout-policy-campspot-privacy-link {
        font-family: proxima-nova, helvetica, arial, sans-serif !important;
        font-size: .875rem !important;
        }

        .sensible-weather-terms-and-conditions, .sensible-weather-privacy-policy, .underline {
        font-size: .875rem !important;
        }

        .underline {
        font-size: .688rem !important;
        }

        .icon-paw,
        .icon-wheelchair {
        position: relative !important;
        top: .125em !important;
        }
        .checkout-summary-add-on {
        margin-top: 12px !important;
        }
        .checkout-summary-item {
        width: 100% !important;
        }
        .checkout-summary-item-title {
        font-size: .9375rem !important;
        font-weight: 700 !important; 
        line-height: 1.25 !important
        }
        .checkout-summary-item-price {
        font-size: .9375rem !important;
        font-weight: 700 !important;
        line-height: 1.25 !important;
        padding-left: 10px !important;
        text-align: right !important;
        vertical-align: top !important
        }
        .checkout-summary-item-details {
        font-size: .875rem
        }
        table {
        border-collapse: collapse
        }

        .checkout-summary-title {
        color: #767676;
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 20px
        }
        .checkout-summary-site {
        margin-bottom: 20px
        }
        /**/

        /*! Exported with https://markflow.app */
        /*! Inherited styles */
        .checkout-content {
        border-collapse: separate !important;
        border-spacing: 0px 0px !important;
        caption-side: top !important;
        color: #000 !important;
        cursor: auto !important;
        direction: ltr !important;
        empty-cells: show !important;
        font: 16px/24px proxima-nova, helvetica, arial, sans-serif !important;
        letter-spacing: normal !important;
        list-style: none !important;
        orphans: 2 !important;
        quotes: auto !important;
        speak: normal !important;
        text-align: left !important;
        text-indent: 0 !important;
        text-transform: none !important;
        visibility: visible !important;
        white-space: normal !important;
        widows: 2 !important;
        word-spacing: 0px !important
        }

        .checkout {
        box-sizing: content-box !important;
        margin-left: auto !important;
        margin-right: auto !important;
        padding-left: 60px !important;
        padding-right: 60px !important;
        max-width: 1050px !important;
        padding-top: 120px !important
        }

        .checkout-heading {
        padding-bottom: 40px !important
        }

        .checkout-heading-title {
        font-size: 2rem !important;
        font-weight: 700 !important
        }

        .checkout-content {
        display: flex !important
        }

        .checkout-summary {
        flex-shrink: 0 !important;
        margin-left: 30px !important;
        margin-bottom: 80px !important;
        order: 2 !important;
        width: 370px !important
        }

        .checkout-summary-sticky {
        position: sticky !important;
        top: 40px !important
        }

        .checkout-summary-content {
        background: #fff !important;
        border: 1px solid #ccc !important;
        border-radius: 3px !important;
        padding: 30px !important
        }

        .checkout-summary-title {
        color: #767676 !important;
        font-size: 1rem !important;
        font-weight: 700 !important;
        margin-bottom: 20px !important
        }

        .checkout-summary-site {
        margin-bottom: 20px !important
        }

        .checkout-summary-item {
        width: 100% !important
        }

        .checkout-summary-sensible-weather {
        margin-top: 12px !important;
        padding: 12px 0 !important;
        border-top: 1px solid #ddd !important;
        border-bottom: 1px solid #ddd !important;
        }

        .checkout-summary-item-title {
        font-size: .9375rem !important;
        font-weight: 700 !important;
        line-height: 1.25 !important;
        }

        .checkout-summary-item-price {
        font-size: .9375rem !important;
        font-weight: 700 !important;
        line-height: 1.25 !important;
        padding-left: 10px !important;
        text-align: right !important;
        vertical-align: top !important
        }

        .checkout-summary-item-details {
        font-size: .875rem !important
        }

        table {
        border-collapse: collapse !important
        }

        .checkout-summary-totals {
        font-size: .9375rem !important;
        font-weight: 700 !important;
        width: 100% !important
        } 

        th {
        text-align: inherit !important
        }

        .checkout-summary-totals-amount {
        text-align: right !important
        }

        .checkout-summary-policies {
        font-size: .875rem !important;
        margin-top: 20px !important
        } 

        .checkout-summary-policies a {
        cursor: pointer !important;
        display: block !important;
        width: fit-content !important;
        font-size: inherit !important;
        line-height: inherit !important;
        }

        .checkout-form {
        flex-grow: 1 !important;
        order: 1 !important
        }

        .checkout-form-field.mod-address-2 {
        margin-top: 10px !important
        }

        .checkout-form-field-toggle {
        background: 0 0 !important;
        border: none !important;
        color: var(--primary) !important;
        cursor: pointer !important;
        font-size: .8125rem !important;
        padding: 0 !important;
        text-decoration: underline !important;
        transition: color .1s ease-in-out, text-decoration-style .1s ease-in-out !important
        }

        .checkout-form-field-input.mod-postal-code {
        max-width: 170px !important
        }

        .checkout-form-field.mod-email {
        margin-top: 30px !important
        } 

        .checkout-form-field.mod-phone {
        max-width: 240px !important
        }

        .checkout-form-field-texting-toggle {
        align-items: center !important;
        background: 0 0 !important;
        border: none !important;
        color: var(--primary) !important;
        cursor: pointer !important;
        font-size: .875rem !important;
        padding: 0 !important;
        text-decoration: underline !important;
        transition: color .1s ease-in-out !important
        }

        svg:not(:root) {
        overflow: hidden !important
        }

        .checkout-form-field-texting-toggle-icon {
        bottom: 1px !important;
        margin-left: 4px !important;
        position: relative !important
        }

        .checkout-form-field-texting-toggle-icon-path {
        fill: var(--primary) !important
        }

        .checkout-form-field-input-dropdown {
        background: #f5f5f5 !important;
        border: 1px solid #bbb !important;
        border-radius: 3px !important;
        cursor: pointer !important;
        display: block !important;
        height: 2.5rem !important;
        max-width: 100% !important;
        padding: 0 12px !important
        }

        .checkout-form-field-input-dropdown.mod-full {
        width: 100% !important
        }

        .checkout-form-field {
        display: block !important;
        max-width: 450px !important
        } 

        .checkout-form-field+.checkout-form-field {
        margin-top: 16px !important
        }

        .checkout-form-field-label {
        display: block !important;
        font-size: .8125rem !important;
        font-weight: 700 !important;
        margin-bottom: 2px !important
        }

        .checkout-form-field-label-note {
        color: #767676 !important;
        float: right !important;
        font-size: .8125rem !important;
        font-weight: 400 !important
        }

        textarea {
        overflow: auto !important;
        resize: vertical !important
        }

        .checkout-form-field-input {
        border: 1px solid #bbb !important;
        border-radius: 3px !important;
        display: block !important;
        min-height: 2.25rem !important;
        min-width: 0 !important;
        padding: 6px 10px !important;
        width: 100% !important
        }

        .checkout-form-section-group+.checkout-form-section-group {
        border-top: 1px solid #ddd !important;
        margin-top: 44px !important;
        padding-top: 40px !important
        }

        img {
        vertical-align: middle !important;
        border-style: none !important
        }

        .sensible-weather-logo[_ngcontent-campspot-aggregator-c115] {
        margin-top: -24px !important
        }

        .checkout-form-sensible-weather[_ngcontent-campspot-aggregator-c115] {
        font-size: .875rem !important;
        font-weight: 500 !important
        }

        dl,
        ol,
        ul {
        margin-top: 0 !important;
        margin-bottom: 0 !important
        }

        .checkout-form-sensible-weather[_ngcontent-campspot-aggregator-c115] ul[_ngcontent-campspot-aggregator-c115] {
        padding-inline-start: 20px !important
        }

        .checkout-form-sensible-weather[_ngcontent-campspot-aggregator-c115] .sensible-weather-privacy-policy[_ngcontent-campspot-aggregator-c115],
        .checkout-form-sensible-weather[_ngcontent-campspot-aggregator-c115] .sensible-weather-terms-and-conditions[_ngcontent-campspot-aggregator-c115] {
        text-decoration: underline !important
        }

        .checkout-form-field-checkbox {
        display: flex !important;
        font-size: .9375rem !important;
        width: fit-content !important
        }

        input[type=checkbox],
        input[type=radio] {
        box-sizing: border-box !important;
        padding: 0 !important
        }

        .checkout-form-field-checkbox input {
        flex-shrink: 0 !important;
        height: 1em !important;
        margin-right: 8px !important;
        margin-top: .25em !important;
        width: 1em !important;
        }

        label {
        display: inline-block !important;
        margin-bottom: 0 !important
        }

        .checkout-form-sensible-weather[_ngcontent-campspot-aggregator-c115] .price[_ngcontent-campspot-aggregator-c115] {
        color: var(--primary) !important;
        font-weight: 700 !important
        }

        .checkout-form-sensible-weather[_ngcontent-campspot-aggregator-c115]>[_ngcontent-campspot-aggregator-c115]:not(:first-child) {
        margin-top: 15px !important
        }

        .checkout-form-sensible-weather[_ngcontent-campspot-aggregator-c115] .smaller[_ngcontent-campspot-aggregator-c115] {
        font-size: .688rem !important
        }

        a {
        background-color: transparent !important;
        color: var(--primary) !important;
        text-decoration: none !important;
        transition: color .1s ease-in-out, text-decoration-style .1s ease-in-out !important
        }

        .checkout-form-sensible-weather[_ngcontent-campspot-aggregator-c115] .underline[_ngcontent-campspot-aggregator-c115] {
        text-decoration: underline !important
        }

        .checkout-form-recaptcha-card-connect,
        .checkout-form-submit {
        margin-top: 40px !important
        }

        [role=button],
        a,
        area,
        button,
        input:not([type=range]),
        label,
        select,
        summary,
        textarea {
        touch-action: manipulation !important
        }

        button {
        border-radius: 0 !important
        }

        button,
        input,
        optgroup,
        select,
        textarea {
        margin: 0 !important;
        font-family: inherit !important;
        font-size: inherit !important;
        line-height: inherit !important
        }

        button,
        input {
        overflow: visible !important
        }

        button,
        select {
        text-transform: none !important
        }

        [type=reset],
        [type=submit],
        button,
        html [type=button] {
        appearance: button !important
        }

        .checkout-form-submit-button {
        cursor: pointer !important;
        transition: background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out !important;
        user-select: none !important;
        white-space: nowrap !important;
        background: #1cbb64 !important;
        border: 1px solid #1cbb64 !important;
        box-shadow: rgba(0, 0, 0, .12) 0 1px 1px !important;
        color: #fff !important;
        font-weight: 600 !important;
        border-radius: 4px !important;
        font-size: 1.125rem !important;
        min-height: 60px !important;
        min-width: 250px !important;
        padding: 12px 30px !important
        }

        article,
        aside,
        dialog,
        figcaption,
        figure,
        footer,
        header,
        hgroup,
        main,
        nav,
        section {
        display: block !important
        }

        .checkout-form-section {
        background: #fff !important;
        border-radius: 3px !important;
        box-shadow: rgba(0, 0, 0, .08) 0 1px 1px, rgba(0, 0, 0, .12) 0 1px 3px 1px !important;
        margin-bottom: 30px !important;
        padding: 40px !important;
        position: relative !important
        } 

        .checkout-form-section.mod-disabled {
        background: 0 0 !important;
        border: 1px solid #ddd !important;
        border-radius: 4px !important;
        box-shadow: none !important
        }

        *,
        ::after,
        ::before {
        box-sizing: border-box !important
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p {
        margin: 0 !important
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
        line-height: 1.25 !important
        }

        .checkout-form-section-title {
        color: #767676 !important;
        font-size: 1rem !important;
        margin-bottom: 24px !important
        }

        .checkout-form-section-title.mod-disabled,
        .checkout-form-section-title.mod-static {
        margin-bottom: 0 !important
        }

        @media (max-width:1199px) {
        .checkout {
            padding-left: 40px !important;
            padding-right: 40px !important
        }
        }

        @media (max-width:575px) {
        .checkout {
            padding-top: 50px !important
        }

        .checkout-heading {
            padding-bottom: 30px !important
        }
        }

        @media (max-width:1024px) {
        .checkout {
            max-width: 720px !important
        }

        .checkout-content {
            display: block !important
        }

        .checkout-summary {
            margin: 0 0 30px !important;
            order: 1 !important;
            width: 100% !important
        } 

        .checkout-summary-sticky {
            position: static !important
        }
        }

        @media (max-width:767px) {
        .checkout {
            padding-left: 20px !important;
            padding-right: 20px !important
        }

        .checkout-heading-title {
            font-size: 1.75rem !important
        }

        .checkout-summary {
            margin-bottom: 24px !important
        }

        .checkout-summary-content {
            padding: 40px !important
        }
        }

        @media (max-width:1024px) {
        .checkout-form {
            order: 2 !important
        }
        }

        @media (max-width:575px) {
        .checkout-summary-content {
            padding: 20px !important
        }

        .checkout-form-submit-button {
            width: 100% !important
        }

        .checkout-form-section {
            padding: 20px 20px 24px !important
        }
        }

        /* 2 */
        .checkout-form-readonly-edit {
        cursor: pointer !important;
        transition: background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out !important;
        user-select: none !important;
        white-space: nowrap !important;
        background: #fff !important;
        border: 1px solid #ccc !important;
        border-radius: 3px !important;
        font-size: .8125rem !important;
        min-width: 60px !important;
        min-height: 1.75rem !important;
        padding: 0 10px !important;
        position: absolute !important;
        right: 40px !important;
        top: 32px !important
        }

        .checkout-form-readonly-field+.checkout-form-readonly-field {
        margin-top: 16px !important
        } 

        .checkout-form-readonly-field-label {
        font-size: .8125rem !important;
        font-weight: 700 !important
        }

        .checkout-form-payment-amount.is-selected,
        .checkout-form-payment-method.is-selected {
        border: 2px solid #06f !important
        }

        .checkout-form-payment-amount-selectable.is-selected,
        .checkout-form-payment-method-selectable.is-selected {
        min-height: 88px !important;
        padding: 21px 23px !important
        }

        .checkout-form-payment-amount-selectable-value {
        font-size: 1.25rem !important;
        font-weight: 700 !important;
        line-height: 1.25 !important
        }

        .checkout-form-payment-amount,
        .checkout-form-payment-method {
        border: 1px solid #ddd !important;
        border-radius: 4px !important;
        transition: border-color .1s ease-in-out !important
        }

        .checkout-form-payment-amount+.checkout-form-payment-amount,
        .checkout-form-payment-method+.checkout-form-payment-method {
        margin-top: 16px !important
        }

        .checkout-form-payment-amount-selectable,
        .checkout-form-payment-method-selectable {
        align-items: center !important;
        cursor: pointer !important;
        display: flex !important;
        min-height: 90px !important;
        padding: 22px 24px !important
        }

        .checkout-form-payment-amount-selectable-radio,
        .checkout-form-payment-method-selectable-radio {
        margin-right: 20px !important
        }

        input[type=checkbox],
        input[type=radio] {
        box-sizing: border-box !important;
        padding: 0 !important
        }

        .checkout-form-payment-amount-selectable-radio input,
        .checkout-form-payment-method-selectable-radio input {
        cursor: pointer !important;
        display: block !important;
        flex-shrink: 0 !important;
        height: 16px !important;
        width: 16px !important
        }

        .checkout-form-payment-amount-selectable-label {
        color: #666 !important;
        font-size: .8125rem !important;
        font-weight: 600 !important;
        margin-bottom: 2px !important
        }

        .checkout-form-payment-amount-selectable-custom-amount {
        position: relative !important
        }

        .checkout-form-payment-amount-selectable-custom-amount-input {
        border: 1px solid #bbb !important;
        border-radius: 3px !important;
        display: block !important;
        font-size: 1.25rem !important;
        font-weight: 700 !important;
        max-width: 170px !important;
        min-height: 2.25rem !important;
        min-width: 0 !important;
        transition: .15s ease-in-out !important;
        padding: 6px 10px 6px 32px !important;
        width: 100% !important
        }

        .checkout-form-field-footnote {
        color: #767676 !important;
        font-size: .8125rem !important;
        line-height: 1.25 !important;
        margin-top: 4px !important
        }

        .checkout-promo-code {
        margin-top: 20px !important
        }

        .checkout-promo-code-toggle {
        background: 0 0 !important;
        border: none !important;
        color: var(--primary);
        cursor: pointer !important;
        font-size: .8125rem !important;
        padding: 0 !important;
        transition: color .1s ease-in-out, text-decoration-style .1s ease-in-out !important;
        text-decoration: underline !important
        }

        .checkout-promo-code-form {
        background: #f8f8f8 !important;
        border-radius: 3px !important;
        margin-top: 4px !important;
        padding: 12px 16px !important
        }

        .checkout-promo-code-form-label {
        display: block !important;
        font-size: .8125rem !important;
        font-weight: 700 !important;
        margin-bottom: 2px !important
        }

        .checkout-promo-code-form-field {
        max-width: 300px !important;
        position: relative !important
        }

        .checkout-promo-code-form-field-input {
        border: 1px solid #bbb !important;
        border-radius: 3px !important;
        display: block !important;
        font-size: .875rem !important;
        min-height: 2rem !important;
        padding: 6px 10px !important;
        width: 100% !important
        }

        .checkout-promo-code-feedback {
        color: #707070 !important;
        font-size: .8125rem !important;
        line-height: 1.25 !important;
        margin-top: 4px !important
        }

        .checkout-form-recaptcha-card-connect,
        .checkout-form-submit {
        margin-top: 40px !important
        }

        /* summary  */

        /*! Exported with https://markflow.app */
        /*! Inherited styles */
        body {
        border-collapse: separate !important;
        border-spacing: 0px 0px !important;
        caption-side: top !important;
        color: #000 !important;
        cursor: auto !important;
        direction: ltr !important;
        empty-cells: show !important;
        font: 16px/24px proxima-nova, helvetica, arial, sans-serif !important;
        letter-spacing: normal !important;
        list-style: none !important;
        orphans: 2 !important;
        quotes: auto !important;
        speak: normal !important;
        text-align: left !important;
        text-indent: 0 !important;
        text-transform: none !important;
        visibility: visible !important;
        white-space: normal !important;
        widows: 2 !important;
        word-spacing: 0px
        }

        .checkout-summary-content {
        background: #fff !important;
        border: 1px solid #ccc !important;
        border-radius: 3px !important;
        padding: 30px !important
        }

        .checkout-summary-title {
        color: #767676 !important;
        font-size: 1rem !important;
        font-weight: 700 !important;
        margin-bottom: 20px !important
        }

        .checkout-summary-site {
        margin-bottom: 20px !important
        }

        .checkout-summary-sensible-weather {
        margin-top: 12px !important;
        padding: 12px 0 !important;
        border-top: 1px solid #ddd !important;
        border-bottom: 1px solid #ddd !important
        }

        .checkout-summary-item {
        width: 100% !important
        }

        .checkout-summary-item-title {
        font-size: .9375rem !important;
        font-weight: 700 !important;
        line-height: 1.25 !important
        }

        .checkout-summary-item-price {
        font-size: .9375rem !important;
        font-weight: 700 !important;
        line-height: 1.25 !important;
        padding-left: 10px !important;
        text-align: right !important;
        vertical-align: top !important
        }

        .checkout-summary-item-details {
        font-size: .875rem !important
        }

        table {
        border-collapse: collapse !important
        } 

        .checkout-summary-totals {
        font-size: .9375rem !important;
        font-weight: 700 !important;
        width: 100% !important
        }

        th {
        text-align: inherit !important
        }

        .checkout-summary-totals-amount {
        text-align: right !important
        }

        .checkout-summary-policies {
        font-size: .875rem !important;
        margin-top: 20px !important
        }

        *,
        ::after,
        ::before {
        box-sizing: border-box !important
        }

        .checkout-content a {
        background-color: transparent !important;
        color: var(--primary) !important;
        text-decoration: none !important;
        transition: color .1s ease-in-out, text-decoration-style .1s ease-in-out !important
        }

        [role=button],
        a,
        area,
        button,
        input:not([type=range]),
        label,
        select,
        summary,
        textarea {
        touch-action: manipulation !important
        }

        .checkout-summary-policies a {
        cursor: pointer !important;
        display: block !important;
        width: fit-content !important
        }

        @media (max-width:767px) {
        .checkout-summary-content {
            padding: 40px !important
        }
        }

        @media (max-width:575px) {
        .checkout-summary-content {
            padding: 20px !important
        }
        }

        /* Custom */
        table tbody>tr:nth-child(odd)>td,
        table tbody>tr:nth-child(odd)>th {
        background-color: inherit !important;
        }

        table td,
        table th {
        padding: 0px !important;
        vertical-align: auto !important;
        border: 0px !important;
        }

        /* Payment Method */
        .checkout-form-field-cardconnect-iframe {
        display: block !important;
        height: 38px !important;
        width: 100% !important
        }

        .checkout-form-field-cc-exp {
        align-items: center !important;
        border: 1px solid #bbb !important;
        border-radius: 3px !important;
        display: flex !important;
        width: 120px !important
        }

        .checkout-form-field-cc-exp-divider {
        color: #767676 !important;
        padding: 0 4px !important
        }

        .checkout-form-field-input.mod-cc-exp {
        border: none !important;
        padding-left: 0 !important;
        padding-right: 0 !important;
        text-align: center !important
        }

        .checkout-form-field-input.mod-cc-cvv {
        max-width: 120px !important
        }

        .checkout-form-field-checkbox.mod-billing-address {
        margin-top: 30px !important
        }

        .checkout-form-agreement {
        font-size: .875rem !important;
        display: flex !important
        }

        .checkout-form-field-checkbox {
        display: flex !important;
        font-size: .9375rem !important;
        width: fit-content !important;
        margin-top: 5px !important;
        }

        input[type=checkbox],
        input[type=radio] {
        box-sizing: border-box !important;
        padding: 0 !important
        } 

        /* Enhanced visual elements for checkout page */

        /* Consistent border treatment */
        .checkout-form-section,
        .checkout-summary-content {
            border: none !important;
            border-radius: 12px !important;
            box-shadow: 0 5px 20px rgba(5, 54, 65, 0.1) !important;
            position: relative !important;
            overflow: hidden !important;
        }

        /* Decorative top border for all sections */
        .checkout-form-section::before,
        .checkout-summary-content::before {
            content: '' !important;
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            width: 100% !important;
            height: 4px !important;
            background: linear-gradient(to right, var(--primary), var(--secondary)) !important;
            z-index: 1 !important;
        }

        /* Add more visual interest to section headers */
        .checkout-form-section-title {
            position: relative !important;
            padding-bottom: 15px !important;
            margin-bottom: 25px !important;
            color: var(--primary) !important;
            font-size: 1.25rem !important;
            font-weight: 600 !important;
        }

        /* Custom numbered section indicators */
        .checkout-form-section-title:before {
            content: attr(data-number) !important;
            position: relative !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            margin-right: 12px !important;
            width: 30px !important;
            height: 30px !important;
            background: var(--secondary) !important;
            color: white !important;
            border-radius: 50% !important;
            font-size: 0.9rem !important;
            font-weight: 600 !important;
            box-shadow: 0 2px 5px rgba(255, 150, 0, 0.2) !important;
        }

        /* Fix section title data attributes */
        .checkout-form-section:nth-of-type(2) .checkout-form-section-title:before {
            content: "1" !important;
        }

        .checkout-form-section:nth-of-type(3) .checkout-form-section-title:before {
            content: "2" !important;
        }

        .checkout-form-section:nth-of-type(4) .checkout-form-section-title:before {
            content: "3" !important;
        }

        .checkout-form-section:nth-of-type(5) .checkout-form-section-title:before {
            content: "4" !important;
        }

        /* Decorative corner elements */
        .checkout-form-section::after,
        .checkout-summary-content::after {
            content: '' !important;
            position: absolute !important;
            top: 0 !important;
            right: 0 !important;
            width: 60px !important;
            height: 60px !important;
            background: linear-gradient(135deg, transparent 50%, rgba(5, 54, 65, 0.03) 50%) !important;
            z-index: 0 !important;
        }

        /* Section dividers with improved visuals */
        .checkout-form-section-group + .checkout-form-section-group {
            position: relative !important;
            border-top: none !important;
            margin-top: 2.5rem !important;
            padding-top: 2.5rem !important;
        }

        .checkout-form-section-group + .checkout-form-section-group::before {
            content: '' !important;
            position: absolute !important;
            top: 0 !important;
            left: -2rem !important;
            right: -2rem !important;
            height: 1px !important;
            background: linear-gradient(to right, 
                transparent 0%, 
                rgba(5, 54, 65, 0.08) 15%, 
                rgba(5, 54, 65, 0.15) 50%, 
                rgba(5, 54, 65, 0.08) 85%, 
                transparent 100%) !important;
        }

        /* Enhanced summary section */
        .checkout-summary-title {
            position: relative !important;
            color: var(--primary) !important;
            font-size: 1.25rem !important;
            font-weight: 600 !important;
            padding-bottom: 12px !important;
            margin-bottom: 20px !important;
            border-bottom: 2px solid var(--secondary) !important;
        }

        /* Add decorative icon to summary section */
        .checkout-summary-title::before {
            content: '' !important;
            display: inline-block !important;
            width: 20px !important;
            height: 20px !important;
            margin-right: 8px !important;
            background: var(--secondary) !important;
            mask-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath d='M4 7v14h17V7H4zm8.5 10.857h-5v-1.714h5v1.714zm5 0h-2.5v-1.714h2.5v1.714zm0-3.429h-10v-1.714h10v1.714zm0-3.428h-10V9.286h10V11zM2.992 5h18v2h-18V5zm.008-2h18v2h-18V3z' fill='%23ffffff'/%3E%3C/svg%3E") !important;
            mask-size: cover !important;
            -webkit-mask-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath d='M4 7v14h17V7H4zm8.5 10.857h-5v-1.714h5v1.714zm5 0h-2.5v-1.714h2.5v1.714zm0-3.429h-10v-1.714h10v1.714zm0-3.428h-10V9.286h10V11zM2.992 5h18v2h-18V5zm.008-2h18v2h-18V3z' fill='%23ffffff'/%3E%3C/svg%3E") !important;
            -webkit-mask-size: cover !important;
            vertical-align: text-bottom !important;
        }

        /* Order summary item styling */
        .checkout-summary-item {
            position: relative !important;
            padding: 12px 0 !important;
            border-radius: 8px !important;
        }

        .checkout-summary-item::after {
            content: '' !important;
            position: absolute !important;
            bottom: 0 !important;
            left: 0 !important;
            right: 0 !important;
            height: 1px !important;
            background: linear-gradient(to right, transparent, rgba(5, 54, 65, 0.1), transparent) !important;
        }

        /* Enhanced total amount display */
        .checkout-summary-totals {
            background-color: rgba(5, 54, 65, 0.03) !important;
            padding: 15px 12px !important;
            border-radius: 8px !important;
            margin-top: 15px !important;
            position: relative !important;
            overflow: hidden !important;
        }

        .checkout-summary-totals::before {
            content: '' !important;
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            width: 4px !important;
            height: 100% !important;
            background: var(--secondary) !important;
        }

        .checkout-summary-totals-amount {
            color: var(--primary) !important;
            font-weight: 700 !important;
            font-size: 1.15rem !important;
        }

        /* Enhanced payment sections */
        .checkout-form-payment-amount {
            background-color: #ffffff !important;
            border-radius: 12px !important;
            box-shadow: 0 2px 8px rgba(5, 54, 65, 0.08) !important;
            border: 2px solid rgba(5, 54, 65, 0.1) !important;
            overflow: hidden !important;
            transition: all 0.2s ease !important;
            position: relative !important;
        }

        .checkout-form-payment-amount.is-selected {
            border: 2px solid var(--secondary) !important;
            background-color: rgba(255, 150, 0, 0.02) !important;
            box-shadow: 0 4px 12px rgba(255, 150, 0, 0.1) !important;
        }

        /* Improved promo code section */
        .checkout-promo-code-form {
            background: linear-gradient(to right bottom, rgba(5, 54, 65, 0.02), rgba(255, 150, 0, 0.02)) !important;
            border-radius: 10px !important;
            border: 1px dashed rgba(5, 54, 65, 0.2) !important;
            position: relative !important;
            overflow: hidden !important;
        }

        .checkout-promo-code-form::before {
            content: '' !important;
            position: absolute !important;
            top: -10px !important;
            right: -10px !important;
            width: 80px !important;
            height: 80px !important;
            background: radial-gradient(circle, rgba(255, 150, 0, 0.05) 0%, transparent 70%) !important;
            border-radius: 50% !important;
        }

        /* Button styling */
        .checkout-form-submit-button {
            position: relative !important;
            background: linear-gradient(45deg, var(--primary), var(--primary-light)) !important;
            border: none !important;
            border-radius: 10px !important;
            font-weight: 600 !important;
            padding: 15px 30px !important;
            transition: all 0.3s ease !important;
            box-shadow: 0 4px 12px rgba(5, 54, 65, 0.2) !important;
            overflow: hidden !important;
            min-width: 250px !important;
        }

        /* Button shine effect */
        .checkout-form-submit-button::after {
            content: '' !important;
            position: absolute !important;
            top: -50% !important;
            left: -50% !important;
            width: 200% !important;
            height: 200% !important;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 0%, transparent 60%) !important;
            opacity: 0 !important;
            transform: scale(0.5) !important;
            transition: transform 0.6s, opacity 0.6s !important;
        }

        .checkout-form-submit-button:hover::after {
            opacity: 1 !important;
            transform: scale(1) !important;
        }

        .checkout-form-submit-button:hover {
            transform: translateY(-2px) !important;
            background: linear-gradient(45deg, var(--primary-dark), var(--primary)) !important;
            box-shadow: 0 6px 16px rgba(5, 54, 65, 0.3) !important;
        }

        /* Enhanced links */
        .checkout-summary-policies a {
            color: var(--primary) !important;
            text-decoration: none !important;
            position: relative !important;
            padding-left: 0 !important;
            display: block !important;
            margin-bottom: 8px !important;
            transition: all 0.2s ease !important;
            border-bottom: 1px solid transparent !important;
        }

        .checkout-summary-policies a:hover::before {
            transform: translateY(-50%) translateX(3px) !important;
        }

        .checkout-summary-policies a:hover {
            color: var(--secondary) !important;
        }

        /* Form fields enhancement */
        .checkout-form-field {
            position: relative !important;
            margin-bottom: 16px !important;
        }

        .checkout-form-field-input,
        .checkout-form-field-input-dropdown,
        textarea.checkout-form-field-input {
            border: 2px solid rgba(5, 54, 65, 0.1) !important;
            border-radius: 8px !important;
            transition: all 0.25s ease !important;
        }

        .checkout-form-field-input:focus,
        .checkout-form-field-input-dropdown:focus,
        textarea.checkout-form-field-input:focus {
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 3px rgba(5, 54, 65, 0.1) !important;
        }

        /* Modal styling enhancement */
        .modal-content {
            border-radius: 14px !important;
            border: none !important;
            box-shadow: 0 10px 30px rgba(5, 54, 65, 0.2) !important;
            padding: 24px !important;
            position: relative !important;
            overflow: hidden !important;
        }

        .modal-content::before {
            content: '' !important;
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            height: 4px !important;
            background: linear-gradient(to right, var(--primary), var(--secondary)) !important;
        }

        /* Decorative pattern for background */
        body::after {
            content: '' !important;
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            height: 100% !important;
            background-image: 
                linear-gradient(rgba(5, 54, 65, 0.01) 1px, transparent 1px),
                linear-gradient(90deg, rgba(5, 54, 65, 0.01) 1px, transparent 1px) !important;
            background-size: 20px 20px !important;
            z-index: -1 !important;
            pointer-events: none !important;
        }

        /* Fix for checkout links color */
        .checkout-content a,
        .checkout-form-field-toggle,
        .checkout-promo-code-toggle {
            color: var(--primary) !important;
        }

        .checkout-content a:hover,
        .checkout-form-field-toggle:hover,
        .checkout-promo-code-toggle:hover {
            color: var(--secondary) !important;
        }

        /* Card payment security indicator */
        #payment-card-number::after {
            content: '🔒 Secure payment' !important;
            position: absolute !important;
            right: 10px !important;
            bottom: -22px !important;
            font-size: 12px !important;
            color: var(--primary) !important;
            opacity: 0.7 !important;
        }

        /* Fix for the spinner overlay */
        .overlay {
            background: rgba(5, 54, 65, 0.7) !important;
            backdrop-filter: blur(3px) !important;
        }

        .spinner {
            border: 8px solid rgba(255, 255, 255, 0.3) !important;
            border-top: 8px solid var(--secondary) !important;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Final checkout button container */
        .checkout-form-submit {
            position: relative !important;
            padding: 10px 0 !important;
            margin-top: 30px !important;
            text-align: center !important;
        }

        /* Section hover effects */
        .checkout-form-section:hover {
            transform: translateY(-2px) !important;
        }

        /* Hover effect for inputs */
        .checkout-form-field-input:hover,
        .checkout-form-field-input-dropdown:hover,
        textarea.checkout-form-field-input:hover {
            border-color: rgba(5, 54, 65, 0.3) !important;
        }

        /* Checkbox styling */
        input[type="checkbox"] {
            box-shadow: 0 0 0 1px rgba(5, 54, 65, 0.2) !important;
            border-radius: 3px !important;
        }

        /* Enhanced term acceptance checkbox */
        #terms-and-conditions {
            position: relative !important;
        }

        #terms-and-conditions-accept {
            width: 18px !important;
            height: 18px !important;
            border: 2px solid var(--primary) !important;
            border-radius: 4px !important;
        }

        #terms-and-conditions-accept:checked {
            background-color: var(--primary) !important;
            border-color: var(--primary) !important;
        }

        /* Add this to your existing CSS */
        .invalid-input {
            border-color: #e74c3c !important;
            background-color: #fff8f8 !important;
            box-shadow: 0 0 0 2px rgba(231, 76, 60, 0.2) !important;
        }
        
        .valid-input {
            border-color: #2ecc71 !important;
            background-color: #f8fff8 !important;
            box-shadow: 0 0 0 2px rgba(46, 204, 113, 0.2) !important;
        }

        /* Improve the focus state for the email field */
        #guest-email-input:focus {
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 3px rgba(15, 109, 152, 0.2) !important;
            outline: none !important;
        }

        /* Prevent text selection and cursor changes on order summary */
        .checkout-summary-content,
        .checkout-summary-item,
        .checkout-summary-item *,
        .checkout-summary-totals,
        .checkout-summary-totals * {
            user-select: none !important;
            -webkit-user-select: none !important;
            -moz-user-select: none !important;
            -ms-user-select: none !important;
            cursor: default !important;
        }

        /* Make sure table cells can't be focused */
        .checkout-summary-item td,
        .checkout-summary-totals td,
        .checkout-summary-item th,
        .checkout-summary-totals th {
            outline: none !important;
            pointer-events: none !important;
        }

        /* Fix for Firefox which sometimes treats tables differently */
        table {
            -moz-user-select: none !important;
        }
    </style>
</head>
<body>
<?php
    function decryptData($token)
    {
        $decoded = base64_decode($token); // Decode Base64
        return json_decode($decoded, true); // Convert JSON string back to an array
    }
    
    // Get parameters from URL
    $parkId = $_GET['parkId'] ?? '';
    $parkSlug = $_GET['parkSlug'] ?? '';
    $cartId = $_GET['cartId'] ?? '';
    $token = $_GET['token'] ?? null;
    
    // Decode token and retrieve data
    $data = $token ? decryptData($token) : [];
    
    // Extract parameters with default values
    $name = $data['n'] ?? '';
    $state = $data['s'] ?? 'California';
    $country = $data['c'] ?? 'United States';
    $city = $data['ct'] ?? 'Alabama';
    $address1 = $data['a'] ?? '';
    $postal = $data['pc'] ?? '';
    $email = $data['e'] ?? '';
    $phone = $data['p'] ?? '';
    $smsMessage = $data['sm'] ?? '';
    $sourceReferral = ($data['sr'] ?? '') === '0' ? 'N/A' : ($data['sr'] ?? 'N/A');
    $reasonStay = ($data['rs'] ?? '') === '0' ? 'N/A' : ($data['rs'] ?? 'N/A');
    $bookingNeed = ($data['bn'] ?? '') === '0' ? 'N/A' : ($data['bn'] ?? 'N/A');
    
    $fullAddress = "$address1, $city, $state $postal, $country";

    $environment = $data['env'] ?? 'campspot-staging';

    // if ($parkId == 92) {
    //     $resortBaseUrl = "https://verderanchrvresort.com/";
    // }

    // else if ($parkId == 1746) {
    //     $resortBaseUrl = "https://coachellalakesrvresort.com/";
    // }

    // else if ($parkId == 2312) {
    //     $resortBaseUrl = "https://savannahlakesrvresort.com/";
    // }

    // else if ($parkId == 491) {
    //     $resortBaseUrl = "https://riversandsrvresort.com/cancellation-policy/";
    // }
    
    ?>

    <div class="page-loader">
        <div class="loader-spinner"></div>
        <div class="loader-text">Loading checkout information...</div>
    </div>

    <div class="a">
        <div class="checkout">
            <section id="app-checkout-heading-title" class="checkout-heading">
                <h1 class="checkout-heading-title app-heading-title"> Checkout </h1>
            </section>
            <section class="checkout-content">
                <div class="checkout-summary">
                    <div class="checkout-summary-sticky">
                        <div class="checkout-summary-content">
                            <div class="checkout-summary-title"> Order Summary </div>
                            <div class="checkout-summary-site">
                                <table class="checkout-summary-item">
                                    <tbody id="order-summary-table-body">
                                        <!-- Dynamic content will be injected here by JavaScript -->
                                    </tbody>
                                </table>
                            </div>
                            <table class="checkout-summary-totals">
                                <tbody>
                                    <tr>
                                        <th scope="row" style="padding-left: 5px !important;">Order Total</th>
                                        <td class="checkout-summary-totals-amount app-checkout-total checkout-summary-order-total">
                                            <span id="order-total">0.00</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="checkout-summary-policies">
                                <a target="_blank" class="app-order-summary-park-cancellation-policy-link" href="https://www.campspot.com/book/<?= $parkSlug ?>/cancellation-policy"> Cancellation Policy </a>
                                <a target="_blank" class="app-order-summary-park-refund-policy-link" href="https://www.campspot.com/book/<?= $parkSlug ?>/refund-policy"> Refund Policy </a>
                            </div>
                        </div>
                    </div>
                </div>
                <form novalidate="" class="checkout-form ng-untouched ng-pristine ng-valid" data-gtm-form-interact-id="0">
                    <card-connect-checkout>
                        <section class="checkout-form-error-summary">
                            <!-- Error summary if needed -->
                        </section>
                        <section class="checkout-form-section">
                        <h1 class="checkout-form-section-title">
                            Guest Information

                            <button type="button" class="collapsible-toggle" onclick="toggleSection('guest-info-content', this)">
                                <span class="arrow-icon">&#9654;</span>
                            </button>
                        </h1>    
                            <div id="guest-info-content" class="collapsible-content" style="display: none;">
                                <div>
                                    <div class="checkout-form-section-group">
                                        <div id="guest-full-name" class="checkout-form-field">
                                            <label for="guest-full-name-input" class="checkout-form-field-label"> Full Name* </label>
                                            <input type="text" name="guest-full-name" required id="guest-full-name-input" aria-describedby="guest-full-name-error" class="checkout-form-field-input ng-untouched ng-pristine ng-valid" value="<?php echo htmlspecialchars($name); ?>" disabled>
                                        </div>
                                        <div id="guest-address" class="checkout-form-field">
                                            <label for="guest-address-line-1" class="checkout-form-field-label"> Address - Line 1* </label>
                                            <input type="text" name="guest-address-line-1" required id="guest-address-line-1" aria-describedby="guest-address-line-1-error" class="checkout-form-field-input ng-untouched ng-pristine ng-valid" value="<?php echo htmlspecialchars($address1); ?>" disabled>
                                        </div>
                                        <div class="checkout-form-field">
                                            <label for="guest-country" class="checkout-form-field-label"> Country* </label>
                                            <input type="text" name="guest-country" id="guest-country" class="checkout-form-field-input ng-untouched ng-pristine ng-valid" value="<?php echo htmlspecialchars($country); ?>" disabled>
                                        </div>
                                        <div id="guest-postal-code" class="checkout-form-field">
                                            <label for="guest-postal-code-input" class="checkout-form-field-label"> Postal Code* </label>
                                            <input type="text" name="guest-postal-code" required minlength="5" id="guest-postal-code-input" aria-describedby="guest-postal-code-error" class="checkout-form-field-input mod-postal-code ng-untouched ng-pristine ng-valid" value="<?php echo htmlspecialchars($postal); ?>" disabled>
                                        </div>
                                        <div id="guest-city" class="checkout-form-field">
                                            <label for="guest-city-input" class="checkout-form-field-label"> City* </label>
                                            <input type="text" name="guest-city" required id="guest-city-input" aria-describedby="guest-city-error" class="checkout-form-field-input ng-untouched ng-pristine ng-valid" value="<?php echo htmlspecialchars($city); ?>" disabled>
                                        </div>
                                        <div id="guest-state" class="checkout-form-field">
                                            <label for="guest-state-select" class="checkout-form-field-label"> State* </label>
                                            <input type="text" name="guest-state" id="guest-state-select" aria-describedby="guest-state-error" class="checkout-form-field-input ng-untouched ng-pristine ng-valid" value="<?php echo htmlspecialchars($state); ?>" disabled>
                                        </div>
                                        <div id="guest-email" class="checkout-form-field mod-email">
                                            <label for="guest-email-input" class="checkout-form-field-label"> Email Address* <div class="checkout-form-field-label-note"> Your order confirmation will be sent here </div>
                                            </label>
                                            <input type="email" name="guest-email" required id="guest-email-input" aria-describedby="guest-email-error" class="checkout-form-field-input ng-untouched ng-pristine ng-valid" value="<?php echo htmlspecialchars($email); ?>">
                                        </div>
                                        <div id="guest-phone-number" class="checkout-form-field mod-phone">
                                            <label for="guest-phone-number-input" class="checkout-form-field-label"> Phone Number* <div class="checkout-form-field-label-note"> (###) ###-#### </div>
                                            </label>
                                            <input type="tel" name="guest-phone-number" required id="guest-phone-number-input" aria-describedby="guest-phone-number-error" phonenumberinputdirective="" class="checkout-form-field-input ng-untouched ng-pristine ng-valid" value="<?php echo htmlspecialchars($phone); ?>" disabled>
                                        </div>
                                        <div class="checkout-form-field">
                                            <div class="checkout-form-field-checkbox">
                                                <input id="checkout-form-field-text-opt-in" type="checkbox" disabled>
                                                <label for="checkout-form-field-text-opt-in" style="margin-top: 3px;">
                                                    Receive text alerts about this reservation. 
                                                    <button type="button" class="checkout-form-field-texting-toggle" aria-pressed="true"> 
                                                        View Details
                                                        <svg width="10" height="7" class="checkout-form-field-texting-toggle-icon mod-hide">
                                                            <path fill-rule="nonzero" d="M5 5.004L8.996 1 10 1.997 5 7 0 1.997 1 1z" class="checkout-form-field-texting-toggle-icon-path"></path>
                                                        </svg>
                                                    </button>
                                                </label>
                                            </div>
                                            <div id="checkout-form-field-texting-detail" style="display: none; margin-top: 15px; font-size: .875rem">
                                                By opting in, you authorize Campspot and its partners to send recurring transactional and promotional text messages. Frequency may vary. Consent is optional, not a condition of purchase. Message and data rates may apply 
                                                <a target="_blank" href="https://www.campspot.com/about/terms-and-conditions" style="font-size: .875rem;">Terms</a> and 
                                                <a target="_blank" href="https://www.campspot.com/about/privacy" style="font-size: .875rem;">Privacy Notice</a> apply.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="checkout-form-section-group">
                                    <div class="checkout-form-field">
                                        <label for="guest-referral-source" class="checkout-form-field-label"> How did you hear about us? <div class="checkout-form-field-label-note"> Optional </div>
                                        </label>
                                        <input type="text" name="guest-referral-source" id="guest-referral-source" class="checkout-form-field-input ng-untouched ng-pristine ng-valid" value="<?php echo htmlspecialchars($sourceReferral); ?>" disabled>
                                    </div>
                                    <div class="checkout-form-field">
                                        <label for="guest-reason-for-visit" class="checkout-form-field-label"> Reason for Visit <div class="checkout-form-field-label-note"> Optional </div>
                                        </label>
                                        <input type="text" name="guest-reason-for-visit" id="guest-reason-for-visit" class="checkout-form-field-input ng-untouched ng-pristine ng-valid" value="<?php echo htmlspecialchars($reasonStay); ?>" disabled>
                                    </div>
                                    <div class="checkout-form-field">
                                        <label for="guest-reservation-note" class="checkout-form-field-label"> 
                                            Special Needs or Requests 
                                            <div class="checkout-form-field-label-note"> Optional </div>
                                        </label>
                                        <textarea name="guest-reservation-note" id="guest-reservation-note" rows="3" class="checkout-form-field-input ng-untouched ng-pristine ng-valid" disabled><?php echo htmlspecialchars($bookingNeed); ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section id="app-payment-amount-fragment" class="checkout-form-section">
                            <h1 class="checkout-form-section-title">Payment Amount</h1>
                            <div>
                                <div class="checkout-form-payment-amount is-selected">
                                    <label class="checkout-form-payment-amount-selectable is-selected">
                                        <div class="checkout-form-payment-method-selectable-radio">
                                            <input type="radio" id="payment-amount-total" name="payment_amount" class="app-pay-total-balance-radio" value="total" checked>
                                        </div>
                                        <div>
                                            <div class="checkout-form-payment-amount-selectable-label">Pay Total Balance</div>
                                            <div class="checkout-form-payment-amount-selectable-value">
                                                <span id="total-balance-placeholder">$0.00</span>
                                            </div>
                                        </div>
                                    </label>

                                    <label class="checkout-form-payment-amount-selectable">
                                        <div class="checkout-form-payment-method-selectable-radio">
                                            <input type="radio" id="payment-amount-partial" name="payment_amount" class="app-pay-total-balance-radio" value="partial" data-partial-value="0">
                                        </div>
                                        <div>
                                            <div class="checkout-form-payment-amount-selectable-label">Pay Partial Balance</div>
                                            <div class="checkout-form-payment-amount-selectable-value" id="payment-amount-partial-value">$0.00</div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <div class="checkout-promo-code">
                                <apply-promo-code>
                                    <div class="checkout-promo-code-form">
                                        <label for="checkout-promo-code-input" class="checkout-promo-code-form-label app-promo-code-search-input-label">
                                            Promo Code
                                        </label>
                                        <div class="checkout-promo-code-form-field">
                                            <input 
                                                id="checkout-promo-code-input"
                                                type="text"
                                                maxlength="128"
                                                class="checkout-promo-code-form-field-input app-promo-code-search-input"
                                                aria-label="Enter promo code">
                                        </div>
                                    </div>
                                </apply-promo-code>
                            </div>
                        </section>

                        <section class="checkout-form-section">
                            <h1 class="checkout-form-section-title">Payment Method</h1>
                            <div>
                                <label id="payment-card-number" class="checkout-form-field">
                                    <div class="checkout-form-field-label"> Card Number* </div>
                                        <iframe title="CardConnect Card Number" id="tokenFrame" name="tokenFrame" frameborder="0" scrolling="no" class="checkout-form-field-cardconnect-iframe app-cc-iframe" src="https://boltgw-uat.cardconnect.com/itoke/ajax-tokenizer.html?tokenizewheninactive=true&amp;inactivityto=3000&amp;css=body%7Bmargin%3A0%3B%7Dinput%7Bborder%3A1px%20solid%20%23bbb%3Bborder-radius%3A3px%3Bbox-sizing%3Aborder-box%3Bfont-family%3Asans-serif%3Bfont-size%3A16px%3Bheight%3A38px%3Bline-height%3A1.5%3Bpadding%3A6px%2010px%3Bwidth%3A100%25%3B%7Dinput%3Afocus%7Bborder-color%3A%2366a3ff%3Boutline%3A0%3B%7D&amp;invalidinputevent=true&amp;formatinput=true"></iframe>
                                    <input type="hidden" required id="mytoken" name="mytoken" />
                                </label>
                                <div id="payment-expiration-date" class="checkout-form-field">
                                    <div class="checkout-form-field-label"> Expiration Date* </div>
                                    <div class="checkout-form-field-cc-exp">
                                        <input type="tel" maxlength="2" name="payment-expiration-date-month" required id="month" placeholder="MM" aria-label="Expiration Month (MM)" aria-describedby="payment-expiration-date-error" class="checkout-form-field-input mod-cc-exp ng-untouched ng-pristine ng-valid">
                                        <div class="checkout-form-field-cc-exp-divider"> / </div>
                                        <input type="tel" maxlength="2" name="payment-expiration-date-year" required id="year" placeholder="YY" aria-label="Expiration Year (YY)" aria-describedby="payment-expiration-date-error" class="checkout-form-field-input mod-cc-exp ng-untouched ng-pristine ng-valid">
                                    </div>
                                </div>
                                <div id="payment-security-code" class="checkout-form-field">
                                    <label for="payment-security-code-input" class="checkout-form-field-label" style="padding-bottom: 5px;"> Security Code (CVV)* </label>
                                    <input type="text" maxlength="4" name="payment-security-code" required id="payment-security-code-input" aria-describedby="payment-security-code-error" class="checkout-form-field-input mod-cc-cvv ng-untouched ng-pristine ng-valid">
                                </div>
                                <input type="hidden" id="mytoken" name="mytoken">
                                <div class="checkout-form-field-checkbox mod-billing-address">
                                    <input type="checkbox" name="payment-billing-info-same-as-guest-info" id="payment-billing-info-same-as-guest-info" class="app-checkout-billing-info-same-as-guest-checkbox" checked>
                                    <label for="payment-billing-info-same-as-guest-info" style="margin-top: 3px;"> Billing information is same as guest information </label>
                                </div>
                            </div>
                        </section>
                        <section class="checkout-form-section app-checkout-policy-component">
                            <checkout-policy-v2>
                                <section class="checkout-policy">
                                    <div class="checkout-form-agreement">
                                        <div id="terms-and-conditions" class="checkout-form-field-checkbox input">
                                            <input aria-label="Checkbox to accept all campground and Campspot policies, Terms & Conditions and Privacy Notice" type="checkbox" id="terms-and-conditions-accept" class="app-terms-and-conditions-accept" style="border: 1px solid black; appearance: auto;">
                                        </div>
                                        <div>
                                            <span class="app-show-checkbox-enabled-dialog"> I acknowledge that I have reviewed and accept the campground's </span>
                                            <a target="_blank" class="app-checkout-policy-park-terms-link" href="https://www.campspot.com/book/<?= $parkSlug ?>/terms-and-conditions">Policies, Terms & Conditions </a>, in addition to Campspot platform's <a target="_blank" class="app-checkout-policy-campspot-terms-link" href="https://www.campspot.com/about/terms-and-conditions">Terms & Conditions </a> and <a target="_blank" class="app-checkout-policy-campspot-privacy-link" href="https://www.campspot.com/about/privacy">Privacy Notice </a>.
                                        </div>
                                    </div>
                                </section>
                            </checkout-policy-v2>
                        </section>

                        <!-- Modal Structure (Hidden by Default) -->
                        <div id="termsModal" class="modal" style="display: none;">
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <p>Please accept the terms and conditions to proceed with your order.</p>
                                <button id="closeTermsModalButton">OK</button> 
                            </div>
                        </div>

                        <div id="paymentErrorModal" class="modal" style="display: none;">
                            <div class="modal-content">
                                <span class="close">&times;</span> 
                                <p>There was an error processing your payment. Please try again or try a different card.</p>
                                <button id="closePaymentErrorModalButton">OK</button> 
                            </div>
                        </div>

                        <div id="cardNotReadyModal" class="modal" style="display: none;">
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <p>We're still processing your card. Please wait a moment and try again.</p>
                                <button id="closeCardNotReadyModalButton">OK</button>
                            </div>
                        </div>

                        <div id="emailErrorModal" class="modal" style="display: none;">
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <p>Please enter a valid email address to continue with your order.</p>
                                <button id="closeEmailModalButton">OK</button>
                            </div>
                        </div>

                        <div class="checkout-form-submit">
                            <button type="button" onclick="submitPaymentForm(cartId, parkId)" class="checkout-form-submit-button mod-place-order app-checkout-submit"> Place Order </button>
                        </div>
                    </card-connect-checkout>
                </form>
            </section>
        </div>
    </div>

    <!-- Add the JavaScript at the bottom of the body -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <!-- Displaying Sites -->
    <script>
        let cartId, parkId, email;
        var smsMessage = <?php echo json_encode($smsMessage); ?>; // Convert PHP string to JS string
        var environment = <?php echo json_encode($environment); ?>; // Convert PHP string to JS string

        // Modal close function
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Event listener to close modals when 'OK' button is clicked
        $('#closeTermsModalButton').click(function (event) {
            event.preventDefault(); // Prevent any form submission or page refresh
            closeModal('termsModal');
        });

        $('#closePaymentErrorModalButton').click(function (event) {
            event.preventDefault(); // Prevent any form submission or page refresh
            closeModal('paymentErrorModal');
        });

        $('#closeCardNotReadyModalButton').click(function(event) {
            event.preventDefault();
            closeModal('cardNotReadyModal');
            // Focus on the card iframe to draw user attention
            document.getElementById('tokenFrame').focus();
        });

        $('#closeEmailModalButton').click(function(event) {
            event.preventDefault();
            closeModal('emailErrorModal');
            // Focus on the email field
            document.getElementById('guest-email-input').focus();
        });

        // Also allow clicking the 'X' (close) button
        $('.close').click(function () {
            // Find the closest modal and close it
            $(this).closest('.modal').hide();
        });

        // Function to get 'cartId' from the URL
        function getCartIdFromUrl() {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get('cartId'); // Adjust 'cartId' to match the query parameter in your URL
        }

        function setLocalStorageWithExpiry(key, value, ttl) {
            const now = new Date().getTime();
            const item = {
                value: value,
                expiry: now + ttl,
            };
            localStorage.setItem(key, JSON.stringify(item));
        }

        // Declare debounceTimer globally
        let debounceTimer;

        $('#checkout-promo-code-input').on('input', function () {
            // Clear previous debounce timer to reset delay
            clearTimeout(debounceTimer);

            // Convert input to uppercase
            let promoCode = $(this).val().trim().toUpperCase();
            $(this).val(promoCode); // Ensure the input field reflects the uppercase value

            const messageElement = $('#promo-code-message');

            if (promoCode) {
                // Only show "Applying..." message (don't clear previous success message if it exists)
                if (!messageElement.text().includes('successfully')) {
                    messageElement.text('Applying promo code...').css({
                        'color': '#0066cc',  // Changed from blue to a more professional color
                        'font-size': '.875rem'
                    });
                }

                // Set a new debounce timer
                debounceTimer = setTimeout(() => {
                    addPromo(promoCode); // Call addPromo after 500ms of inactivity
                }, 500);
            } else {
                messageElement.text(''); // Clear message if input is empty
            }
        });

        // Handle Billing Information checkbox
        $('#payment-billing-info-same-as-guest-info').change(function () {
            if ($(this).is(':checked')) {
                $('.checkout-form-billing-address').hide();
            } else {
                if ($('.checkout-form-billing-address').length === 0) {
                    $(this).closest('.checkout-form-section').append(`
                        <div class="checkout-form-billing-address">
                            <h3 class="checkout-form-billing-address-title"> Billing Information </h3>
                            <div id="billing-name-on-card" class="checkout-form-field">
                                <label for="billing-name-on-card-input" class="checkout-form-field-label"> Name on Card* </label>
                                <input type="text" name="billing-name-on-card" id="billing-name-on-card-input" aria-describedby="billing-name-on-card-error" class="checkout-form-field-input ng-untouched ng-pristine ng-valid">
                            </div>
                            <div id="billing-address-line-1" class="checkout-form-field">
                                <label for="billing-address-line-1-input" class="checkout-form-field-label"> Address - Line 1* </label>
                                <input type="text" name="billing-address-line-1" id="billing-address-line-1-input" aria-describedby="billing-address-line-1-error" class="checkout-form-field-input ng-untouched ng-pristine ng-valid">
                            </div>
                            <div class="checkout-form-field">
                                <label for="billing-country" class="checkout-form-field-label"> Country* </label>
                                <select name="billing-country" id="billing-country" class="checkout-form-field-input-dropdown app-billing-info-country-select ng-untouched ng-pristine ng-valid">
                                    <option> United States </option>
                                    <option> Canada </option><!---->
                                    <option> Afghanistan </option>
                                    <option> Åland Islands </option>
                                    <option> Albania </option>
                                    <option> Algeria </option>
                                    <option> American Samoa </option>
                                    <option> Andorra </option>
                                    <option> Angola </option>
                                    <option> Anguilla </option>
                                    <option> Antarctica </option>
                                    <option> Antigua and Barbuda </option>
                                    <option> Argentina </option>
                                    <option> Armenia </option>
                                    <option> Aruba </option>
                                    <option> Australia </option>
                                    <option> Austria </option>
                                    <option> Azerbaijan </option>
                                    <option> Bahamas </option>
                                    <option> Bahrain </option>
                                    <option> Bangladesh </option>
                                    <option> Barbados </option>
                                    <option> Belarus </option>
                                    <option> Belgium </option>
                                    <option> Belize </option>
                                    <option> Benin </option>
                                    <option> Bermuda </option>
                                    <option> Bhutan </option>
                                    <option> Bolivia </option>
                                    <option> Bosnia and Herzegovina </option>
                                    <option> Botswana </option>
                                    <option> Bouvet Island </option>
                                    <option> Brazil </option>
                                    <option> British Indian Ocean Territory </option>
                                    <option> British Virgin Islands </option>
                                    <option> Brunei </option>
                                    <option> Bulgaria </option>
                                    <option> Burkina Faso </option>
                                    <option> Burundi </option>
                                    <option> Cambodia </option>
                                    <option> Cameroon </option>
                                    <option> Cape Verde </option>
                                    <option> Cayman Islands </option>
                                    <option> Central African Republic </option>
                                    <option> Chad </option>
                                    <option> Chile </option>
                                    <option> China </option>
                                    <option> Christmas Island </option>
                                    <option> Cocos (Keeling) Islands </option>
                                    <option> Colombia </option>
                                    <option> Comoros </option>
                                    <option> Cook Islands </option>
                                    <option> Costa Rica </option>
                                    <option> Croatia </option>
                                    <option> Cuba </option>
                                    <option> Curaçao </option>
                                    <option> Cyprus </option>
                                    <option> Czechia </option>
                                    <option> Denmark </option>
                                    <option> Djibouti </option>
                                    <option> Dominica </option>
                                    <option> Dominican Republic </option>
                                    <option> DR Congo </option>
                                    <option> Ecuador </option>
                                    <option> Egypt </option>
                                    <option> El Salvador </option>
                                    <option> Equatorial Guinea </option>
                                    <option> Eritrea </option>
                                    <option> Estonia </option>
                                    <option> Ethiopia </option>
                                    <option> Falkland Islands </option>
                                    <option> Faroe Islands </option>
                                    <option> Fiji </option>
                                    <option> Finland </option>
                                    <option> France </option>
                                    <option> French Guiana </option>
                                    <option> French Polynesia </option>
                                    <option> French Southern and Antarctic Lands </option>
                                    <option> Gabon </option>
                                    <option> Gambia </option>
                                    <option> Georgia </option>
                                    <option> Germany </option>
                                    <option> Ghana </option>
                                    <option> Gibraltar </option>
                                    <option> Greece </option>
                                    <option> Greenland </option>
                                    <option> Grenada </option>
                                    <option> Guadeloupe </option>
                                    <option> Guam </option>
                                    <option> Guatemala </option>
                                    <option> Guernsey </option>
                                    <option> Guinea </option>
                                    <option> Guinea-Bissau </option>
                                    <option> Guyana </option>
                                    <option> Haiti </option>
                                    <option> Heard Island and McDonald Islands </option>
                                    <option> Honduras </option>
                                    <option> Hong Kong </option>
                                    <option> Hungary </option>
                                    <option> Iceland </option>
                                    <option> India </option>
                                    <option> Indonesia </option>
                                    <option> Iran </option>
                                    <option> Iraq </option>
                                    <option> Ireland </option>
                                    <option> Isle of Man </option>
                                    <option> Israel </option>
                                    <option> Italy </option>
                                    <option> Ivory Coast </option>
                                    <option> Jamaica </option>
                                    <option> Japan </option>
                                    <option> Jersey </option>
                                    <option> Jordan </option>
                                    <option> Kazakhstan </option>
                                    <option> Kenya </option>
                                    <option> Kiribati </option>
                                    <option> Kosovo </option>
                                    <option> Kuwait </option>
                                    <option> Kyrgyzstan </option>
                                    <option> Laos </option>
                                    <option> Latvia </option>
                                    <option> Lebanon </option>
                                    <option> Lesotho </option>
                                    <option> Liberia </option>
                                    <option> Libya </option>
                                    <option> Liechtenstein </option>
                                    <option> Lithuania </option>
                                    <option> Luxembourg </option>
                                    <option> Macau </option>
                                    <option> Macedonia </option>
                                    <option> Madagascar </option>
                                    <option> Malawi </option>
                                    <option> Malaysia </option>
                                    <option> Maldives </option>
                                    <option> Mali </option>
                                    <option> Malta </option>
                                    <option> Marshall Islands </option>
                                    <option> Martinique </option>
                                    <option> Mauritania </option>
                                    <option> Mauritius </option>
                                    <option> Mayotte </option>
                                    <option> Mexico </option>
                                    <option> Micronesia </option>
                                    <option> Moldova </option>
                                    <option> Monaco </option>
                                    <option> Mongolia </option>
                                    <option> Montenegro </option>
                                    <option> Montserrat </option>
                                    <option> Morocco </option>
                                    <option> Mozambique </option>
                                    <option> Myanmar </option>
                                    <option> Namibia </option>
                                    <option> Nauru </option>
                                    <option> Nepal </option>
                                    <option> Netherlands </option>
                                    <option> New Caledonia </option>
                                    <option> New Zealand </option>
                                    <option> Nicaragua </option>
                                    <option> Niger </option>
                                    <option> Nigeria </option>
                                    <option> Niue </option>
                                    <option> Norfolk Island </option>
                                    <option> North Korea </option>
                                    <option> Northern Mariana Islands </option>
                                    <option> Norway </option>
                                    <option> Oman </option>
                                    <option> Pakistan </option>
                                    <option> Palau </option>
                                    <option> Palestine </option>
                                    <option> Panama </option>
                                    <option> Papua New Guinea </option>
                                    <option> Paraguay </option>
                                    <option> Peru </option>
                                    <option> Philippines </option>
                                    <option> Pitcairn Islands </option>
                                    <option> Poland </option>
                                    <option> Portugal </option>
                                    <option> Puerto Rico </option>
                                    <option> Qatar </option>
                                    <option> Republic of the Congo </option>
                                    <option> Romania </option>
                                    <option> Russia </option>
                                    <option> Rwanda </option>
                                    <option> Réunion </option>
                                    <option> Saint Barthélemy </option>
                                    <option> Saint Kitts and Nevis </option>
                                    <option> Saint Lucia </option>
                                    <option> Saint Martin </option>
                                    <option> Saint Pierre and Miquelon </option>
                                    <option> Saint Vincent and the Grenadines </option>
                                    <option> Samoa </option>
                                    <option> San Marino </option>
                                    <option> Saudi Arabia </option>
                                    <option> Senegal </option>
                                    <option> Serbia </option>
                                    <option> Seychelles </option>
                                    <option> Sierra Leone </option>
                                    <option> Singapore </option>
                                    <option> Sint Maarten </option>
                                    <option> Slovakia </option>
                                    <option> Slovenia </option>
                                    <option> Solomon Islands </option>
                                    <option> Somalia </option>
                                    <option> South Africa </option>
                                    <option> South Georgia </option>
                                    <option> South Korea </option>
                                    <option> South Sudan </option>
                                    <option> Spain </option>
                                    <option> Sri Lanka </option>
                                    <option> Sudan </option>
                                    <option> Suriname </option>
                                    <option> Svalbard and Jan Mayen </option>
                                    <option> Swaziland </option>
                                    <option> Sweden </option>
                                    <option> Switzerland </option>
                                    <option> Syria </option>
                                    <option> São Tomé and Príncipe </option>
                                    <option> Taiwan </option>
                                    <option> Tajikistan </option>
                                    <option> Tanzania </option>
                                    <option> Thailand </option>
                                    <option> Timor-Leste </option>
                                    <option> Togo </option>
                                    <option> Tokelau </option>
                                    <option> Tonga </option>
                                    <option> Trinidad and Tobago </option>
                                    <option> Tunisia </option>
                                    <option> Turkey </option>
                                    <option> Turkmenistan </option>
                                    <option> Turks and Caicos Islands </option>
                                    <option> Tuvalu </option>
                                    <option> Uganda </option>
                                    <option> Ukraine </option>
                                    <option> United Arab Emirates </option>
                                    <option> United Kingdom </option>
                                    <option> United States Minor Outlying Islands </option>
                                    <option> United States Virgin Islands </option>
                                    <option> Uruguay </option>
                                    <option> Uzbekistan </option>
                                    <option> Vanuatu </option>
                                    <option> Vatican City </option>
                                    <option> Venezuela </option>
                                    <option> Vietnam </option>
                                    <option> Wallis and Futuna </option>
                                    <option> Western Sahara </option>
                                    <option> Yemen </option>
                                    <option> Zambia </option>
                                    <option> Zimbabwe </option><!---->
                                </select>
                            </div>
                            <div id="billing-postal-code" class="checkout-form-field">
                                <label for="billing-postal-code-input" class="checkout-form-field-label"> Postal Code* </label>
                                <input type="text" minlength="5" name="billing-postal-code" id="billing-postal-code-input" aria-describedby="billing-postal-code-error" class="checkout-form-field-input mod-postal-code ng-untouched ng-pristine ng-valid">
                            </div>
                            <div id="billing-city" class="checkout-form-field">
                                <label for="billing-city-input" class="checkout-form-field-label"> City* </label>
                                <input type="text" name="billing-city" id="billing-city-input" aria-describedby="billing-city-error" class="checkout-form-field-input ng-untouched ng-pristine ng-valid">
                            </div>
                            <div id="billing-state" class="checkout-form-field">
                                <label for="billing-state-select" class="checkout-form-field-label"> State* </label>
                                <select name="billing-state" id="billing-state-select" aria-describedby="billing-state-error" class="checkout-form-field-input-dropdown ng-untouched ng-pristine ng-valid">
                                    <option> Alabama </option>
                                    <option> Alaska </option>
                                    <option> American Samoa </option>
                                    <option> Arizona </option>
                                    <option> Arkansas </option>
                                    <option> Armed Forces (AA) </option>
                                    <option> Armed Forces (AE) </option>
                                    <option> Armed Forces (AP) </option>
                                    <option> California </option>
                                    <option> Colorado </option>
                                    <option> Connecticut </option>
                                    <option> Delaware </option>
                                    <option> District of Columbia </option>
                                    <option> Federated States of Micronesia </option>
                                    <option> Florida </option>
                                    <option> Georgia </option>
                                    <option> Guam </option>
                                    <option> Hawaii </option>
                                    <option> Idaho </option>
                                    <option> Illinois </option>
                                    <option> Indiana </option>
                                    <option> Iowa </option>
                                    <option> Kansas </option>
                                    <option> Kentucky </option>
                                    <option> Louisiana </option>
                                    <option> Maine </option>
                                    <option> Marshall Islands </option>
                                    <option> Maryland </option>
                                    <option> Massachusetts </option>
                                    <option> Michigan </option>
                                    <option> Minnesota </option>
                                    <option> Mississippi </option>
                                    <option> Missouri </option>
                                    <option> Montana </option>
                                    <option> Nebraska </option>
                                    <option> Nevada </option>
                                    <option> New Hampshire </option>
                                    <option> New Jersey </option>
                                    <option> New Mexico </option>
                                    <option> New York </option>
                                    <option> North Carolina </option>
                                    <option> North Dakota </option>
                                    <option> Northern Mariana Islands </option>
                                    <option> Ohio </option>
                                    <option> Oklahoma </option>
                                    <option> Oregon </option>
                                    <option> Palau </option>
                                    <option> Pennsylvania </option>
                                    <option> Puerto Rico </option>
                                    <option> Rhode Island </option>
                                    <option> South Carolina </option>
                                    <option> South Dakota </option>
                                    <option> Tennessee </option>
                                    <option> Texas </option>
                                    <option> Utah </option>
                                    <option> Vermont </option>
                                    <option> Virgin Islands </option>
                                    <option> Virginia </option>
                                    <option> Washington </option>
                                    <option> West Virginia </option>
                                    <option> Wisconsin </option>
                                    <option> Wyoming </option><!---->
                                </select>
                            </div>
                        </div>
                    `);
                } else {
                    $('.checkout-form-billing-address').show();
                }
            }
        });

        function processCampsite(campsite) {
            const campsiteTypeId = campsite.campsiteType.id;
            const campsiteName = campsite.campsiteType.name;
            const campName = campsite.campsite.name;
            const campId = campsite.campsite.id;
            const amenities = campsite.campsite.amenities;
            const petFriendly = campsite.campsiteType.isPetFriendly;
            const siteLock = String(campsite?.siteLocationLocked ?? false);
            const checkin = new Date(campsite.checkinDateInParkTimeZone);
            const checkout = new Date(campsite.checkoutDateInParkTimeZone);
            const children = campsite.guestCategories.ageCategories.find(category => category.name === 'Children')?.count || 0;
            const adults = campsite.guestCategories.ageCategories.find(category => category.name === 'Adults')?.count || 0;
            const pets = campsite.guestCategories.pets || 0;
            const totalBaseRate = campsite.pricing.tripTotalBeforeTaxesFeesAndDiscounts;
            const pricePerNight = campsite.pricing.averagePricePerNightBeforeTaxesAndFees;
            const taxes = campsite.pricing.totalTaxes;

            let lockFee, lockFeeTaxes, petFee, bookingFee, campFees, totalPrice, allFees;

            // Determine which fee set to use based on siteLock
            if (siteLock === 'true') {
                lockFee = campsite.pricing.feeSummary.itemizedCampgroundFeesWithLockFee.find(fee => fee.feeType === "SITE_LOCK_FEE")?.price || 0;
                lockFeeTaxes = campsite.pricing.feeSummary.lockFeeTaxes || 0;
                petFee = campsite.pricing.feeSummary.itemizedCampgroundFeesWithLockFee.find(fee => fee.feeType === "PET_FEES")?.price || 0;
                bookingFee = campsite.pricing.feeSummary.itemizedCampgroundFeesWithLockFee.find(fee => fee.feeType === "SURCHARGES")?.price || 0;
                campFees = campsite.pricing.feeSummary.totalCampgroundFeesWithLockFee + campsite.pricing.feeSummary.lockFeeTaxes;
                totalPrice = campsite.pricing.tripTotalWithLockSiteFee;
                
                // Use entire itemizedCampgroundFeesWithLockFee array
                allFees = campsite.pricing.feeSummary.itemizedCampgroundFeesWithLockFee || [];
            } else {
                lockFee = 0;
                lockFeeTaxes = 0;
                petFee = campsite.pricing.feeSummary.itemizedCampgroundFeesWithoutLockFee.find(fee => fee.feeType === "PET_FEES")?.price || 0;
                bookingFee = campsite.pricing.feeSummary.itemizedCampgroundFeesWithoutLockFee.find(fee => fee.feeType === "SURCHARGES")?.price || 0;
                campFees = campsite.pricing.feeSummary.totalCampgroundFeesWithoutLockFee;
                totalPrice = campsite.pricing.tripTotal;
                
                // Use entire itemizedCampgroundFeesWithoutLockFee array
                allFees = campsite.pricing.feeSummary.itemizedCampgroundFeesWithoutLockFee || [];
            }

            // Process all package discounts instead of just the first one
            const packageDiscounts = campsite.pricing.packageDiscounts || [];
            
            // Calculate total discount amount for all applied discounts
            const totalDiscountAmount = packageDiscounts.reduce((total, discount) => total + (discount.price || 0), 0);
            
            // Create an array of discount objects with name and price
            const discounts = packageDiscounts.map(discount => ({
                name: discount.name,
                price: discount.price || 0
            }));

            const imageUrl = campsite.campsiteType.images.mainImage.medium.url;
            const siteType = campsite.campsiteType.campsiteCategoryCode;
            const reservationDetailId = campsite.reservationDetailId;

            let dailyRateAddons = [];
            if (campsite.dailyRateAddons.length > 0) {
                for (const addOn of campsite.dailyRateAddons) {
                    dailyRateAddons.push({
                        addOnName: addOn.name,
                        addOnTypeId: addOn.typeId,
                        addOnCheckin: addOn.checkinDateInParkTimeZone,
                        addOnCheckout: addOn.checkoutDateInParkTimeZone,
                        addOnImg: addOn.images.mainImage.medium.url,
                        addOnTotal: addOn.pricing.tripTotal,
                        dailyRateAddonReservationId: addOn.dailyRateAddonReservationDetailId,
                        reservationDetailId,
                        campsiteTypeId,
                        campsiteName,
                        checkin,
                        checkout
                    });
                }
            }

            let onlineStoreAddons = [];
            if (campsite.onlineStoreAddons.length > 0) {
                for (const addOn of campsite.onlineStoreAddons) {
                    onlineStoreAddons.push({
                        addOnName: addOn.name,
                        addOnTypeId: addOn.typeId,
                        addOnQuantity: addOn.quantity,
                        addOnImg: addOn.images.slideshowImages.length > 0 ? addOn.images.mainImage.medium.url : "https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/2048px-No_image_available.svg.png",
                        addOnTotal: addOn.pricing.tripTotal,
                        reservationDetailId,
                        campsiteTypeId,
                        campsiteName,
                        checkin,
                        checkout
                    });
                }
            }

            return {
                campsiteTypeId,
                campsiteName,
                campName,
                campId,
                amenities,
                petFriendly,
                siteLock,
                checkin,
                checkout,
                children,
                adults,
                pets,
                totalBaseRate,
                pricePerNight,
                taxes,
                lockFee,
                lockFeeTaxes,
                petFee,
                bookingFee,
                campFees,
                discounts,
                totalDiscountAmount,
                totalPrice,
                imageUrl,
                siteType,
                dailyRateAddons,
                onlineStoreAddons,
                allFees,  // Make sure allFees is included here
                ...(siteType === "rv" ? { rvInfo: campsite.rvInfo } : {}),
                reservationDetailId
            };
        }

        async function fetchCart() {
            let storedCartData = localStorage.getItem('cartData');
            let storedSubTotal = localStorage.getItem('grandTotal');
            let storedParkName = localStorage.getItem('parkName');
            let storedExternalCharges = localStorage.getItem('externalCharges');

            if (storedCartData && storedSubTotal) {
                // Set global variables from localStorage if available
                window.parkName = storedParkName || '';
                // Properly parse the external charges from localStorage
                window.externalCharges = storedExternalCharges ? JSON.parse(storedExternalCharges) : [];
                displayAvailableCampsite(JSON.parse(storedCartData), parseFloat(storedSubTotal));
            } else {
                const overlay = $('.overlay');
                const spinner = $('.spinner');

                overlay.show();
                spinner.show();

                const baseUrl = `https://insiderperks.com/wp-content/endpoints/${environment}/get-cart-checkout.php`;
                const params = { cartId: cartId, parkId: parkId };
                const queryString = Object.keys(params).map(key => `${encodeURIComponent(key)}=${encodeURIComponent(params[key])}`).join('&');
                const urlWithParams = `${baseUrl}?${queryString}`;

                try {
                    const response = await fetch(urlWithParams);
                    const cart = await response.json();
                    console.log("Cart response:", cart);

                    const minimumPayment = cart.minimumPayment?.minimumPayment || 0;
                    const campsites = cart.cart.parkShoppingCarts[parkId].shoppingCartItems || [];
                    const grandTotal = cart.cart.parkShoppingCarts[parkId].grandTotal || 0;
                    
                    // Store park name globally
                    window.parkName = cart.cart.parkShoppingCarts[parkId].parkName || '';
                    
                    // Specifically extract the externalCharges from the correct location in the JSON
                    window.externalCharges = cart.cart.parkShoppingCarts[parkId].externalCharges || [];
                    console.log("External charges found:", window.externalCharges);
                    
                    // Store in localStorage for future use - ensure we stringify the array properly
                    localStorage.setItem('parkName', window.parkName);
                    localStorage.setItem('externalCharges', JSON.stringify(window.externalCharges));
                    
                    // After the cart data is loaded, update the checkout heading to include park name
                    if (window.parkName) {
                        updateCheckoutHeading(window.parkName);
                    }
                    
                    let filteredCampsites = [];

                    if (campsites.length) {
                        for (const campsite of campsites) {
                            const filteredCampsite = processCampsite(campsite);
                            filteredCampsites.push(filteredCampsite);
                        }
                    }

                    // Store processed campsites and grand total for future use
                    localStorage.setItem('cartData', JSON.stringify(filteredCampsites));
                    localStorage.setItem('grandTotal', grandTotal);
                    
                    allCampsites = filteredCampsites;

                    displayAvailableCampsite(allCampsites, grandTotal);
                    updatePaymentAmount(grandTotal, minimumPayment);
                } catch (error) {
                    console.error('Error fetching campground data:', error);
                } finally {
                    overlay.hide();
                    spinner.hide();
                }
            }
        }

        function updateCheckoutHeading(parkName) {
            // Remove any existing park name element first to avoid duplication
            $('.park-name-header').remove();
            
            if (parkName) {
                // Restructure the checkout heading with better text hierarchy and contrast
                $('.checkout-heading').html(`
                    <div class="park-name-header">
                        <div class="park-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                <path d="M12 2L1 7v2h22V7L12 2zm-1 14h2v7h3v-7h2v7h2V9H6v14h2v-7h3v-7z" fill="currentColor"/>
                            </svg>
                        </div>
                        <div class="park-header-content">
                            <h1 class="checkout-heading-title">Checkout</h1>
                            <div class="park-name">${parkName}</div>
                        </div>
                    </div>
                `);
                
                // Add the CSS styles for the new header
                if (!$('#park-name-styles').length) {
                    $('head').append(`
                        <style id="park-name-styles">
                            .park-name-header {
                                background: linear-gradient(to right, var(--primary), var(--primary-light));
                                color: white;
                                padding: 18px 24px;
                                border-radius: 12px;
                                margin-bottom: 30px;
                                display: flex;
                                align-items: center;
                                box-shadow: 0 6px 16px rgba(5, 54, 65, 0.18);
                                position: relative;
                                overflow: hidden;
                            }
                            
                            .park-name-header::before {
                                content: '';
                                position: absolute;
                                top: 0;
                                right: 0;
                                bottom: 0;
                                width: 200px;
                                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1));
                                z-index: 1;
                            }
                            
                            .park-header-content {
                                display: flex;
                                flex-direction: column;
                            }
                            
                            .checkout-heading-title {
                                font-size: 1.5rem !important;
                                font-weight: 700 !important;
                                margin: 0 !important;
                                line-height: 1.3 !important;
                                text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
                            }
                            
                            .park-name {
                                font-size: 1.1rem !important;
                                font-weight: 400 !important;
                                margin: 4px 0 0 0 !important;
                                opacity: 0.9;
                                line-height: 1.2 !important;
                            }
                            
                            .park-icon {
                                margin-right: 16px;
                                background-color: rgba(255, 255, 255, 0.2);
                                border-radius: 50%;
                                width: 48px;
                                height: 48px;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                flex-shrink: 0;
                            }
                            
                            .park-icon svg {
                                width: 28px;
                                height: 28px;
                                color: white;
                            }
                            
                            /* Add a subtle animation to the header */
                            @keyframes subtle-glow {
                                0%, 100% { box-shadow: 0 6px 16px rgba(5, 54, 65, 0.18); }
                                50% { box-shadow: 0 8px 24px rgba(5, 54, 65, 0.25); }
                            }
                            
                            .park-name-header {
                                animation: subtle-glow 5s infinite;
                            }
                            
                            @media (max-width: 767px) {
                                .park-name-header {
                                    padding: 16px 18px;
                                    margin-bottom: 24px;
                                    flex-direction: column;
                                    align-items: center;
                                    text-align: center;
                                }
                                
                                .park-icon {
                                    margin-right: 0;
                                    margin-bottom: 12px;
                                }
                                
                                .checkout-heading-title {
                                    font-size: 1.4rem !important;
                                }
                                
                                .park-name {
                                    font-size: 1rem !important;
                                }
                            }
                        </style>
                    `);
                }
            } else {
                // If no park name, restore original checkout heading
                $('.checkout-heading').html('<h1 class="checkout-heading-title app-heading-title">Checkout</h1>');
            }
        }

        function getMinimumPayment(minimumPayment) {
            //check minimum payment is undefined then hide partial payment
            if (minimumPayment === undefined) {
                //delete the 2nd checkout-form-payment-amount-selectable
                $('.checkout-form-payment-amount-selectable').eq(1).remove();
            } else {
                $('#payment-amount-partial-value').text(`$${minimumPayment.toFixed(2)}`);
                $('#payment-amount-partial').attr('data-partial-value', minimumPayment.toFixed(2));
            }
        }

        function displayDiscounts(discounts) {
            console.log('displayDiscounts called with:', discounts);
            if (!discounts || discounts.length === 0) {
                console.log('No discounts to display');
                return '';
            }
            
            let discountHtml = '<div class="app-checkout-summary-site-discounts" style="margin-top: 5px; color: #0F6D98; font-weight: 500;">';
            
            discounts.forEach(discount => {
                console.log('Processing discount:', discount);
                // Check if discount exists and has a non-zero price (negative or positive)
                if (discount.name && discount.price !== 0) {
                    // For display purposes, show the absolute value with a minus sign
                    const displayPrice = Math.abs(discount.price).toFixed(2);
                    discountHtml += `<div class="discount-item">
                        <span class="discount-name">Discount: ${discount.name}</span>
                        <span class="discount-price" style="color: #FF9600; margin-left: 5px;">-$${displayPrice}</span>
                    </div>`;
                } else {
                    console.log('Skipping discount:', discount);
                }
            });
            
            discountHtml += '</div>';
            
            // Only return the HTML if there are discounts with a non-zero price
            const hasValidDiscounts = discounts.some(d => d.name && d.price !== 0);
            console.log('Has valid discounts:', hasValidDiscounts);
            return hasValidDiscounts ? discountHtml : '';
        }

        // Modified section of the displayAvailableCampsite function to include fee breakdown
        function displayAvailableCampsite(campsites, grandTotal) {
            console.log('displayAvailableCampsite called with', campsites.length, 'campsites');
            const tbody = $('#order-summary-table-body');
            tbody.empty();
            
            campsites.forEach((campsite, index) => {
                console.log(`Processing campsite ${index}:`, campsite.campsiteName);
                
                const numberOfNights = Math.ceil((new Date(campsite.checkout) - new Date(campsite.checkin)) / (1000 * 60 * 60 * 24));
                const discountsHtml = displayDiscounts(campsite.discounts);
                
                // Build the row with expanded pricing details
                const row = $(`
                    <table class="checkout-summary-item">
                        <tbody>
                            <tr>
                                <td class="checkout-summary-item-title app-checkout-summary-site-title">
                                    ${campsite.campsiteName} <span>- ${campsite.campName}</span>
                                    <campsite-name-icons>
                                        <!-- Icons can be added here if needed -->
                                    </campsite-name-icons>
                                </td>
                                <td class="checkout-summary-item-price">
                                    <span>$${campsite.totalPrice.toFixed(2)}</span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="checkout-summary-item-details">
                                    <div>
                                        <span class="app-checkout-summary-site-dates">${formatDateRange(new Date(campsite.checkin), new Date(campsite.checkout))}</span> (${numberOfNights} Nights)
                                    </div>
                                    <div class="app-checkout-summary-site-guests">${formatGuests(campsite.adults, campsite.children, campsite.pets)}</div>
                                    
                                    <!-- Detailed Cost Breakdown -->
                                    <div class="cost-breakdown" style="margin-top: 15px; border-top: 1px dotted #ddd; padding-top: 10px;">
                                        <div style="font-weight: 600; color: var(--primary); margin-bottom: 5px;">Cost Details:</div>

                                        <!-- Base rate -->
                                        <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                                            <span style="color: #4a5568;">Base Rate (${numberOfNights} Night${numberOfNights > 1 ? 's' : ''})</span>
                                            <span style="font-weight: 500; color: var(--primary);">$${campsite.totalBaseRate.toFixed(2)}</span>
                                        </div>

                                        <!-- Dynamic fees will be inserted here -->
                                        <div id="fee-breakdown-${index}" class="fee-breakdown"></div>
                                        
                                        <!-- Additional charges section will be inserted here if applicable -->
                                        <div id="additional-charges-${index}" class="additional-charges-breakdown"></div>

                                        <!-- Taxes -->
                                        <div style="display: flex; justify-content: space-between; margin-top: 8px;">
                                            <span style="color: #4a5568;">Taxes</span>
                                            <span style="font-weight: 500; color: var(--primary);">$${campsite.taxes.toFixed(2)}</span>
                                        </div>

                                        <!-- Show lock fee taxes if applicable -->
                                        ${campsite.siteLock === 'true' ? 
                                        `<div style="display: flex; justify-content: space-between; margin: 4px 0;">
                                            <span style="color: #4a5568;">Lock Fee Taxes</span>
                                            <span style="font-weight: 500; color: var(--primary);">$${campsite.lockFeeTaxes.toFixed(2)}</span>
                                        </div>` : ''}

                                        <!-- Discounts if any -->
                                        ${discountsHtml}
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                `);
                tbody.append(row);
                
                // Populate the fee breakdown after the row is appended to the DOM
                const feeBreakdownDiv = $(`#fee-breakdown-${index}`);
                
                // Updated styling for dynamic fee rows
                if (campsite.allFees && campsite.allFees.length > 0) {
                    // Loop through each fee and add it to the breakdown
                    campsite.allFees.forEach(fee => {
                        // Skip if price is 0
                        if (fee.price === 0) return;
                        
                        const feeRow = $(`
                            <div style="display: flex; justify-content: space-between; margin: 4px 0;">
                                <span style="color: #4a5568;">${fee.name}</span>
                                <span style="font-weight: 500; color: var(--primary);">$${fee.price.toFixed(2)}</span>
                            </div>
                        `);
                        feeBreakdownDiv.append(feeRow);
                    });
                } else if (campsite.lockFee > 0) {
                    // Fallback for when allFees isn't available but we have individual fee data
                    const lockFeeRow = $(`
                        <div style="display: flex; justify-content: space-between; margin: 4px 0;">
                            <span style="color: #4a5568;">Site Lock Fee</span>
                            <span style="font-weight: 500; color: var(--primary);">$${campsite.lockFee.toFixed(2)}</span>
                        </div>
                    `);
                    feeBreakdownDiv.append(lockFeeRow);
                    
                    if (campsite.petFee > 0) {
                        const petFeeRow = $(`
                            <div style="display: flex; justify-content: space-between; margin: 4px 0;">
                                <span style="color: #4a5568;">Pet Fee</span>
                                <span style="font-weight: 500; color: var(--primary);">$${campsite.petFee.toFixed(2)}</span>
                            </div>
                        `);
                        feeBreakdownDiv.append(petFeeRow);
                    }
                    
                    if (campsite.bookingFee > 0) {
                        const bookingFeeRow = $(`
                            <div style="display: flex; justify-content: space-between; margin: 4px 0;">
                                <span style="color: #000000;">Booking Fee</span>
                                <span style="font-weight: 500; color: var(--primary);">$${campsite.bookingFee.toFixed(2)}</span>
                            </div>
                        `);
                        feeBreakdownDiv.append(bookingFeeRow);
                    }
                }

                // Add external charges to the first campsite
                if (index === 0 && window.externalCharges && window.externalCharges.length > 0) {
                    console.log("Adding external charges:", window.externalCharges);
                    
                    // Add each external charge directly to the fee breakdown section
                    window.externalCharges.forEach(charge => {
                        console.log("Processing external charge:", charge);
                        const chargeRow = $(`
                            <div style="display: flex; justify-content: space-between; margin: 4px 0;">
                                <span style="color: #4a5568; display: flex; flex-direction: column;">
                                    ${charge.name}
                                    ${charge.helpText ? 
                                    `<div class="fee-help-text" style="font-size: 0.75rem; color: #666; font-style: italic; max-height: 0; overflow: hidden;">${charge.helpText}</div>` : 
                                    ''}
                                </span>
                                <span style="font-weight: 500; color: var(--primary);">$${parseFloat(charge.price).toFixed(2)}</span>
                            </div>
                        `);
                        feeBreakdownDiv.append(chargeRow);
                    });
                }

                // Display daily rate add-ons
                campsite.dailyRateAddons.forEach(addOn => {
                    const addOnNights = Math.ceil((new Date(addOn.addOnCheckout) - new Date(addOn.addOnCheckin)) / (1000 * 60 * 60 * 24));
                    const addOnRow = $(`
                        <table class="checkout-summary-add-on checkout-summary-item">
                            <tbody>
                                <tr>
                                    <td class="checkout-summary-item-title">Add-on: ${addOn.addOnName}</td>
                                    <td class="checkout-summary-item-price">$${addOn.addOnTotal.toFixed(2)}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="checkout-summary-item-details">${formatDateRange(new Date(addOn.addOnCheckin), new Date(addOn.addOnCheckout))} (${addOnNights} Nights)</td>
                                </tr>
                            </tbody>
                        </table>
                    `);
                    tbody.append(addOnRow);
                });

                // Display online store add-ons
                campsite.onlineStoreAddons.forEach(addOn => {
                    const addOnRow = $(`
                        <table class="checkout-summary-add-on checkout-summary-item">
                            <tbody>
                                <tr>
                                    <td class="checkout-summary-item-title app-checkout-pos-addon-display-name">Add-on: ${addOn.addOnName}</td>
                                    <td class="checkout-summary-item-price app-checkout-pos-addon-trip-total">$${addOn.addOnTotal.toFixed(2)}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="checkout-summary-item-details">Quantity: ${addOn.addOnQuantity}</td>
                                </tr>
                            </tbody>
                        </table>
                    `);
                    tbody.append(addOnRow);
                });
            });

             // Update total display
            $('#order-total').text(`$${grandTotal.toFixed(2)}`);
            
            // Update payment amount displays
            $(document).ready(function() {
                $('.checkout-form-payment-amount-selectable label.is-selected .checkout-form-payment-amount-selectable-value')
                    .text(`$${parseFloat($('#order-total').text().replace('$','')).toFixed(2)}`);

                $('#payment-amount-partial-value').text(`$${$('#payment-amount-partial').data('partial-value')}`);
            });
        }

        // Debug function to check external charges
        function checkExternalCharges() {
            console.log("Current external charges:", window.externalCharges);
            const storedCharges = localStorage.getItem('externalCharges');
            console.log("External charges in localStorage:", storedCharges ? JSON.parse(storedCharges) : 'None');
        }

        // Call this debug function after initial load
        $(document).ready(function() {
            // Existing document.ready code...
            
            // Set a timeout to check external charges after everything else has loaded
            setTimeout(checkExternalCharges, 2000);
            
            // Add hover behavior for fee help text
            $(document).on('mouseenter', '.checkout-summary-item [style*="color: #4a5568"]', function() {
                $(this).find('.fee-help-text').css({
                    'max-height': '200px',
                    'margin-top': '5px',
                    'transition': 'max-height 0.3s ease-in, margin-top 0.3s ease-in'
                });
            }).on('mouseleave', '.checkout-summary-item [style*="color: #4a5568"]', function() {
                $(this).find('.fee-help-text').css({
                    'max-height': '0',
                    'margin-top': '0',
                    'transition': 'max-height 0.3s ease-out, margin-top 0.3s ease-out'
                });
            });
        });

        function formatDateRange(startDate, endDate) {
            // Increment the start date by 1 day
            startDate = incrementDate(startDate);
            endDate = incrementDate(endDate);
            const options = { weekday: 'short', month: 'short', day: 'numeric' };
            const start = startDate.toLocaleDateString('en-US', options);
            const end = endDate.toLocaleDateString('en-US', options);
            return `${start} - ${end}`;
        }

        function incrementDate(date) {
            // Create a new Date object based on the input date
            let newDate = new Date(date);
            // Increment the date by 1
            newDate.setDate(newDate.getDate() + 1);
            return newDate;
        }

        function formatGuests(adults, children, pets) {
            let guestText = '';
            if (adults > 0) guestText += `${adults} Adult${adults > 1 ? 's' : ''}`;
            if (children > 0) {
                if (guestText) guestText += ', ';
                guestText += `${children} Child${children > 1 ? 'ren' : ''}`;
            }
            if(pets > 0) {
                if (guestText) guestText += ', ';
                guestText += `${pets} Pet${pets > 1 ? 's' : ''}`;
            }
            return guestText;
        }

        $('#checkout-promo-code-input').after('<div id="promo-code-message"></div>');

        async function addPromo(promoCode) {
            const baseUrl = `https://insiderperks.com/wp-content/endpoints/${environment}/add-promo.php`;
            const addonData = {
                parkId: parkId,
                cartId: cartId,
                promoCode: promoCode,
            };

            const messageElement = $('#promo-code-message');
            
            // Prevent multiple concurrent requests
            if (messageElement.data('processing') === true) {
                return;
            }
            
            // Set flag to indicate processing
            messageElement.data('processing', true);

            try {
                const response = await fetch(baseUrl, {
                    method: 'POST',
                    body: JSON.stringify(addonData),
                    headers: { 'Content-Type': 'application/json' }
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }

                const data = await response.json();
                console.log('Promo code data:', data);

                // Wait for cart update before showing success message
                if (data.status === 'success' && data.data.applied) {
                    // Fetch the updated cart with the new pricing
                    const baseUrl = `https://insiderperks.com/wp-content/endpoints/${environment}/get-cart-checkout.php`;
                    const params = { cartId: cartId, parkId: parkId };
                    const queryString = Object.keys(params).map(key => `${encodeURIComponent(key)}=${encodeURIComponent(params[key])}`).join('&');
                    const urlWithParams = `${baseUrl}?${queryString}`;
                    
                    const cartResponse = await fetch(urlWithParams);
                    const cart = await cartResponse.json();
                    console.log("Updated cart after promo:", cart);
                    
                    // Extract the minimum payment and grandTotal from the updated cart
                    const minimumPayment = cart.minimumPayment?.minimumPayment || 0.00;
                    const grandTotal = cart.cart.parkShoppingCarts[parkId].grandTotal || 0.00;
                    
                    console.log("New minimum payment after promo:", minimumPayment);
                    console.log("New grandTotal after promo:", grandTotal);
                    
                    // Process campsites for display
                    const campsites = cart.cart.parkShoppingCarts[parkId].shoppingCartItems || [];
                    let filteredCampsites = [];
                    
                    if (campsites.length) {
                        for (const campsite of campsites) {
                            const filteredCampsite = processCampsite(campsite);
                            filteredCampsites.push(filteredCampsite);
                        }
                    }
                    
                    // Force UI update with direct DOM manipulation
                    $('#order-total').text(`$${grandTotal.toFixed(2)}`);
                    $('#total-balance-placeholder').text(`$${grandTotal.toFixed(2)}`);
                    
                    // Update the partial payment amount
                    $('#payment-amount-partial-value').text(`$${minimumPayment.toFixed(2)}`);
                    $('#payment-amount-partial').attr('data-partial-value', minimumPayment.toFixed(2));
                    
                    // Force update of the "Pay Total Balance" value
                    $('#payment-amount-total')
                        .closest('.checkout-form-payment-amount-selectable')
                        .find('.checkout-form-payment-amount-selectable-value')
                        .text(`$${grandTotal.toFixed(2)}`);
                    
                    // Update the display with the new campsites data
                    displayAvailableCampsite(filteredCampsites, grandTotal);
                    
                    messageElement.text('Promo code applied successfully!').css({
                        'color': 'green',
                        'font-size': '.875rem'
                    });
                    
                    // Finally, execute any UI updates that might have been overridden
                    setTimeout(() => {
                        $('#payment-amount-partial-value').text(`$${minimumPayment.toFixed(2)}`);
                    }, 100);
                } else {
                    messageElement.text('Invalid promo code. Please try again.').css({
                        'color': 'red',
                        'font-size': '.875rem'
                    });
                }
            } catch (error) {
                console.error('Error:', error);
                messageElement.text('Error applying promo code.').css({
                    'color': 'red',
                    'font-size': '.875rem'
                });
            } finally {
                // Clear processing flag
                messageElement.data('processing', false);
            }
        }

        // Function to handle delayed input detection
        let typingTimer;
        const doneTypingInterval = 1000; // Adjust delay time in milliseconds

        $(document).ready(function () {
            const promoInput = $('#checkout-promo-code-input');

            // Call addPromo when user stops typing
            promoInput.on('input', function () {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(() => {
                    const promoCode = promoInput.val().trim();
                    if (promoCode) {
                        addPromo(promoCode);
                    }
                }, doneTypingInterval);
            });

            // Call addPromo when input loses focus (user finishes typing)
            promoInput.on('blur', function () {
                const promoCode = promoInput.val().trim();
                if (promoCode) {
                    addPromo(promoCode);
                }
            });
        });

        function updatePaymentAmount(grandTotal, minimumPayment = null) {
            console.log("Updating payment amount...");

            // Ensure elements exist before updating
            if ($('#order-total').length) {
                $('#order-total').text(`$${grandTotal.toFixed(2)}`);
            }

            if ($('.checkout-form-payment-amount-selectable-value').length) {
                $('.checkout-form-payment-amount-selectable label.is-selected .checkout-form-payment-amount-selectable-value')
                    .text(`$${grandTotal.toFixed(2)}`);
            }

            // ✅ Update "Pay Total Balance"
            if ($('#payment-amount-total').length) {
                $('#payment-amount-total').closest('.checkout-form-payment-amount-selectable')
                    .find('.checkout-form-payment-amount-selectable-value')
                    .text(`$${grandTotal.toFixed(2)}`);
            }

            // ✅ Update "Pay Partial Balance"
            if (minimumPayment !== null && $('#payment-amount-partial-value').length) {
                $('#payment-amount-partial-value').text(`$${minimumPayment.toFixed(2)}`);
                $('#payment-amount-partial').attr('data-partial-value', minimumPayment.toFixed(2));
            } else {
                // Hide partial payment option if minimumPayment is not available
                if ($('.checkout-form-payment-amount-selectable').length > 1) {
                    $('.checkout-form-payment-amount-selectable').eq(1).remove();
                }
            }
        }

        // Use cartId from the URL
        cartId = getCartIdFromUrl();

        function getParkIdFromUrl() {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get('parkId'); // Adjust 'parkId' to match the query parameter in your URL
        }

        parkId = getParkIdFromUrl();

        email = email;
        console.log('cartId:', cartId, 'parkId:', parkId, 'email:', email);

        // Handle SMS message checkbox
        $('#checkout-form-field-text-opt-in').change(function () {
            const isChecked = $(this).is(':checked');
            $('#smsMessage').val(isChecked);
        });

        // Handle SMS details toggle
        $('.checkout-form-field-texting-toggle').click(function () {
            const details = $('#checkout-form-field-texting-detail');
            details.toggle();

            if (details.is(':visible')) {
                $(this).html('Hide Details<svg width="10" height="7" class="checkout-form-field-texting-toggle-icon mod-hide"><path fill-rule="nonzero" d="M5 5.004L8.996 1 10 1.997 5 7 0 1.997 1 1z" class="checkout-form-field-texting-toggle-icon-path"></path></svg>');
            } else {
                $(this).html('View Details<svg width="10" height="7" class="checkout-form-field-texting-toggle-icon mod-hide"><path fill-rule="nonzero" d="M5 5.004L8.996 1 10 1.997 5 7 0 1.997 1 1z" class="checkout-form-field-texting-toggle-icon-path"></path></svg>');
            }
        });

        
        function toggleSection(sectionId, button) {
            const section = document.getElementById(sectionId);
            const arrow = button.querySelector('.arrow-icon');
            
            if (section.style.display === "none") {
                section.style.display = "block";
                arrow.classList.add('expanded');
            } else {
                section.style.display = "none";
                arrow.classList.remove('expanded');
            }
        }

        // Initially hide the billing information fields if the checkbox is checked
        if ($('#payment-billing-info-same-as-guest-info').is(':checked')) {
            $('.checkout-form-billing-address').hide();
        }

        $(document).ready(function () {
            console.log("Page loaded, fetching cart data...");
            
            // ✅ Fetch the cart on page load
            fetchCart();

            // ✅ Ensure UI updates properly after page load
            setTimeout(() => {
                const grandTotal = parseFloat($('#order-total').text().replace('$', '')) || 0;
                const minPayment = parseFloat($('#payment-amount-partial-value').text().replace('$', '')) || 0;
            }, 1000); // Delay ensures DOM is ready
        });

        // Tokenization event listener
        window.addEventListener('message', function(event) {
            if (event.origin !== "https://boltgw-uat.cardconnect.com") {
                console.error("Message event origin mismatch:", event.origin);
                return;
            }
            try {
                var tokenData = JSON.parse(event.data);
                if (tokenData && tokenData.message) {
                    document.getElementById('mytoken').value = tokenData.message;
                    console.log("Token assigned:", tokenData.message);
                } else {
                    console.error("Token data format unexpected:", tokenData);
                }
            } catch (error) {
                console.error("Error processing tokenization message:", error);
            }
        }, false);
        
        // Create a modern loading overlay to replace the simple spinner
        function createLoadingOverlay() {
            const overlay = $('<div class="loading-overlay"></div>');
            
            // Create animated loading element
            const loadingContent = $(`
                <div class="loading-content">
                    <div class="loading-spinner">
                        <div class="spinner-circle"></div>
                        <div class="spinner-circle-inner"></div>
                    </div>
                    <div class="loading-text">
                        <p class="loading-title">Processing Payment</p>
                        <p class="loading-message">Please don't close this page...</p>
                    </div>
                </div>
            `);
            
            overlay.append(loadingContent);
            $('body').append(overlay);
            return overlay;
        }

        // Add this right before the end of your script section
        document.addEventListener('DOMContentLoaded', function() {
            const isSmsEnabled = (smsMessage === "true"); // Convert string to boolean

            const checkbox = document.getElementById("checkout-form-field-text-opt-in");
            if (checkbox) {
                checkbox.checked = isSmsEnabled;
                checkbox.disabled = true;
            } else {
                console.warn("Checkbox not found in the DOM!");
            }

            // Fetch cart data, which will update the UI
            fetchCart();
            
            // If DOM is ready but data isn't loaded yet, update loader text
            const pageLoader = document.querySelector('.page-loader');
            const loaderText = pageLoader?.querySelector('.loader-text');
            if (loaderText) {
                loaderText.textContent = "Loading your reservation details...";
            }
            
            // Ensure UI updates properly after all data is ready
            setTimeout(() => {
                // If for some reason the loader is still present after 10 seconds, force remove it
                const pageLoader = document.querySelector('.page-loader');
                if (pageLoader) {
                    pageLoader.classList.add('fade-out');
                    setTimeout(() => pageLoader.remove(), 500);
                }
            }, 10000);
        });

        // Enhance the fetchCart function to work with the page loader
        const originalFetchCart = fetchCart;
        fetchCart = async function() {
            // Keep the page loader visible until cart data is loaded
            const pageLoader = document.querySelector('.page-loader');
            
            try {
                await originalFetchCart(...arguments);
                
                // After data is loaded, update the loader text to show success
                if (pageLoader) {
                    const loaderText = pageLoader.querySelector('.loader-text');
                    if (loaderText) {
                        loaderText.textContent = "Ready!";
                    }
                }
            } finally {
                // Fade out loader with slight delay to show the completion state
                if (pageLoader) {
                    setTimeout(function() {
                        pageLoader.classList.add('fade-out');
                        setTimeout(function() {
                            pageLoader.remove();
                        }, 500);
                    }, 800); // Give users a moment to see everything is ready
                }
            }
        };

        // Add CSS for the loading overlay
        $('head').append(`
            <style>
                .loading-overlay {
                    display: none;
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(5, 54, 65, 0.85);
                    z-index: 2000;
                    backdrop-filter: blur(4px);
                    align-items: center;
                    justify-content: center;
                }
                
                .loading-content {
                    background-color: white;
                    border-radius: 16px;
                    padding: 30px 40px;
                    text-align: center;
                    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
                    max-width: 400px;
                    width: 90%;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                }
                
                .loading-spinner {
                    position: relative;
                    width: 70px;
                    height: 70px;
                    margin-bottom: 20px;
                }
                
                .spinner-circle {
                    position: absolute;
                    width: 100%;
                    height: 100%;
                    border: 4px solid rgba(0, 0, 0, 0.1);
                    border-top: 4px solid var(--secondary);
                    border-radius: 50%;
                    animation: spin 1.5s linear infinite;
                }
                
                .spinner-circle-inner {
                    position: absolute;
                    top: 15px;
                    left: 15px;
                    width: calc(100% - 30px);
                    height: calc(100% - 30px);
                    border: 4px solid transparent;
                    border-bottom: 4px solid var(--primary);
                    border-radius: 50%;
                    animation: spin-reverse 1s linear infinite;
                }
                
                .loading-title {
                    font-size: 1.25rem;
                    font-weight: 600;
                    color: var(--primary);
                    margin-bottom: 8px !important;
                }
                
                .loading-message {
                    font-size: 0.9rem;
                    color: #666;
                }
                
                @keyframes spin {
                    0% { transform: rotate(0deg); }
                    100% { transform: rotate(360deg); }
                }
                
                @keyframes spin-reverse {
                    0% { transform: rotate(0deg); }
                    100% { transform: rotate(-360deg); }
                }
                
                /* Progress bar animation */
                .progress-bar {
                    height: 6px;
                    width: 100%;
                    background-color: #f0f0f0;
                    border-radius: 3px;
                    margin-top: 15px;
                    overflow: hidden;
                    position: relative;
                }
                
                .progress-bar-fill {
                    height: 100%;
                    width: 0%;
                    background: linear-gradient(to right, var(--primary), var(--secondary));
                    position: absolute;
                    animation: fill-progress 20s linear forwards;
                    border-radius: 3px;
                }
                
                @keyframes fill-progress {
                    0% { width: 0%; }
                    100% { width: 100%; }
                }
            </style>
        `);

        // Add this function to handle email field validation and section expansion
        function validateEmailField() {
            const emailField = document.getElementById('guest-email-input');
            
            if (!emailField.value || !emailField.checkValidity()) {
                // Expand the Guest Information section if it's collapsed
                const guestInfoContent = document.getElementById('guest-info-content');
                const toggleButton = document.querySelector('.collapsible-toggle');
                
                if (guestInfoContent && guestInfoContent.style.display === "none") {
                    // Show the section
                    guestInfoContent.style.display = "block";
                    
                    // Update the arrow icon if it exists
                    const arrowIcon = toggleButton.querySelector('.arrow-icon');
                    if (arrowIcon) {
                        arrowIcon.classList.add('expanded');
                    }
                    
                    // Scroll to the section
                    guestInfoContent.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
                
                // Show the modal for invalid email
                document.getElementById('emailErrorModal').style.display = 'block';
                
                // Focus on the email field after showing the modal
                setTimeout(() => {
                    emailField.focus();
                }, 100);
                
                return false;
            }
            
            return true;
        }

        window.submitPaymentForm = async function(cartId, parkId) {
            console.log("Submitting payment form...");

            // Validate email field first - this will now expand the section if needed
            if (!validateEmailField()) {
                return; // Stop if email validation fails
            }
            
            var token = document.getElementById('mytoken').value;
            
            // Check card number token first, before creating the overlay
            if (!token || token.trim() === '') {
                // Display modal for missing card number instead of alert
                document.getElementById('cardNotReadyModal').style.display = 'block';
                return;
            }
            
            // Create and show the new loading overlay
            const loadingOverlay = createLoadingOverlay();
            loadingOverlay.css('display', 'flex');
            
            // Also add a progress bar to the loading content
            loadingOverlay.find('.loading-content').append(
                '<div class="progress-bar"><div class="progress-bar-fill"></div></div>'
            );

            var form = document.querySelector('.checkout-form');

            // Validate the form fields
            if (!form.checkValidity()) {
                form.reportValidity();
                loadingOverlay.hide();
                return;
            }

            // Validate email field
            if (!validateEmailField()) {
                loadingOverlay.hide();
                return;
            }

            var token = document.getElementById('mytoken').value;
            if (!token) {
                console.log("Card information not yet tokenized. Please try again.");
                loadingOverlay.hide();
                return;
            }

            // Get the latest payment values from UI
            function getSelectedPaymentAmount() {
                const selectedPaymentOption = $('input[name="payment_amount"]:checked').val();
                
                if (selectedPaymentOption === 'total') {
                    // Get the latest total amount from the UI
                    return parseFloat($('#order-total').text().replace(/[^0-9.]/g, ''));
                } else if (selectedPaymentOption === 'partial') {
                    // Get the latest partial amount from the UI
                    return parseFloat($('#payment-amount-partial-value').text().replace(/[^0-9.]/g, ''));
                }
                return 0; // Default fallback
            }

            // Ensure the latest amount is used
            const selectedAmount = getSelectedPaymentAmount();
            console.log("DEBUG: Payment Amount Sent: ", selectedAmount);

            // Get the checkbox element
            var termsCheckbox = document.getElementById('terms-and-conditions-accept');

            // Check if the checkbox is checked
            if (!termsCheckbox.checked) {
                // Show the modal if the checkbox is not checked
                document.getElementById('termsModal').style.display = 'block';
                loadingOverlay.hide();
                return; // Prevent form submission
            }

            // Update loading message to show progress
            setTimeout(() => {
                $('.loading-message').text('Validating payment information...');
            }, 1000);

            // Get site summary information
            const siteName = $('#order-summary-table-body').find('.app-checkout-summary-site-title').first().text().trim();
            const siteNumber = $('#order-summary-table-body').find('.checkout-summary-item-details').text().trim();
            
            // Collect all user data for analytics and summary page
            const userData = {
                name: $('#guest-full-name-input').val(),
                state: $('#guest-state-select').val(),
                country: $('#guest-country').val(),
                city: $('#guest-city-input').val(),
                address1: $('#guest-address-line-1').val(),
                postal: $('#guest-postal-code-input').val(),
                email: $('#guest-email-input').val(),
                phone: $('#guest-phone-number-input').val(),
                smsMessage: $('#checkout-form-field-text-opt-in').is(':checked'),
                sourceReferral: $('#guest-referral-source').val(),
                reasonStay: $('#guest-reason-for-visit').val(),
                bookingNeed: $('#guest-reservation-note').val(),
                // Add site and payment info
                siteName: siteName,
                siteInfo: siteNumber,
                paidAmount: selectedAmount,
            };

            // Store user data in localStorage for the summary page
            localStorage.setItem('bookingUserData', JSON.stringify(userData));

            // Prepare data to submit (Ensure we use the latest UI values)
            const data = {
                parkId: parkId,
                shoppingCartUuid: cartId,
                guestName: $('#guest-full-name-input').val(),
                guestEmail: $('#guest-email-input').val(),
                guestPhone: $('#guest-phone-number-input').val(),
                reasonForVisit: $('#guest-reason-for-visit').val(),
                referralSource: $('#guest-referral-source').val(),
                specialRequest: $('#guest-reservation-note').val(),
                shippingName: $('#guest-full-name-input').val(),
                stateProvinceOrRegion: $('#guest-state-select').val(),
                shippingType: "SHIPPING",
                country: $('#guest-country').val(),
                city: $('#guest-city-input').val(),
                address1: $('#guest-address-line-1').val(),
                postalCode: $('#guest-postal-code-input').val(),
                smsMessage: $('#checkout-form-field-text-opt-in').is(':checked'),
                cartId: cartId,
                cvv: $('#payment-security-code-input').val(),
                token: token,
                expiry: $('#month').val() + '/' + $('#year').val(),
                amount: selectedAmount // Use the updated amount from UI
            };

            setLocalStorageWithExpiry('amount', selectedAmount);
            setLocalStorageWithExpiry('environment', environment);

            // If billing info is different
            if (!$('#payment-billing-info-same-as-guest-info').is(':checked')) {
                data.billingName = $('#billing-name-on-card-input').val();
                data.billingAddress1 = $('#billing-address-line-1-input').val();
                data.billingCountry = $('#billing-country').val();
                data.billingPostalCode = $('#billing-postal-code-input').val();
                data.billingCity = $('#billing-city-input').val();
                data.billingState = $('#billing-state-select').val();

                const billingAddress2 = $('#billing-address-line-2').val();
                if (billingAddress2) {
                    data.billingAddress2 = billingAddress2;
                }
            }

            console.log("Data Sent for Save Customer: ", data);

            // Update loading message to show progress
            setTimeout(() => {
                $('.loading-message').text('Contacting payment processor...');
            }, 2500);

            try {
                // Submit the payment request
                const response = await fetch(`https://insiderperks.com/wp-content/endpoints/${environment}/vapi-submit-card.php`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data),
                });

                // Update loading message to show progress
                $('.loading-message').text('Processing payment response...');

                const text = await response.text();
                const details = JSON.parse(text);
                console.log("Save Customer Response: ", details);

                if (details.apiResponse2.status != 'APPROVED') {
                    loadingOverlay.hide();
                    document.getElementById('paymentErrorModal').style.display = 'block';
                    return;
                } else {
                    document.getElementById('paymentErrorModal').style.display = 'none';
                    
                    // Update loading message for successful payment
                    $('.loading-message').text('Payment successful! Redirecting...');
                    
                    // Payment succeeded, prepare for redirect
                    const invoiceUUID = details.apiResponse2.invoiceUUID;
                    setLocalStorageWithExpiry('invoiceUUID', invoiceUUID);
                    setLocalStorageWithExpiry('parkID', parkId);
                    
                    // Short delay before redirect for better UX
                    setTimeout(() => {
                        let baseurl = "https://personal-stg-campspot-checkout-page.onrender.com";
                        window.location.href = `${baseurl}/booking-summary.php?invoiceUUID=${invoiceUUID}&parkId=${parkId}`;
                    }, 1500);
                }
            } catch (error) {
                console.error("Error submitting payment:", error);
                loadingOverlay.hide();
                document.getElementById('paymentErrorModal').style.display = 'block';
            }
        };

        $(document).ready(function() {
            // Add real-time validation for email field
            $('#guest-email-input').on('input blur', function() {
                const emailField = $(this);
                const emailValue = emailField.val().trim();
                
                // Clear any existing validation styling
                emailField.removeClass('invalid-input valid-input');
                
                if (!emailValue) {
                    emailField.addClass('invalid-input');
                } else if (!isValidEmail(emailValue)) {
                    emailField.addClass('invalid-input');
                } else {
                    emailField.addClass('valid-input');
                }
            });
            
            // Helper function to validate email format
            function isValidEmail(email) {
                const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email);
            }
            
            // When the email error modal is closed, make sure the section is expanded and the field is focused
            $('#closeEmailModalButton').click(function(event) {
                event.preventDefault();
                closeModal('emailErrorModal');
                
                // Ensure guest info section is expanded
                const guestInfoContent = document.getElementById('guest-info-content');
                if (guestInfoContent.style.display === "none") {
                    document.querySelector('.collapsible-toggle').click();
                }
                
                // Focus on the email field
                setTimeout(() => {
                    document.getElementById('guest-email-input').focus();
                }, 100);
            });
        });
    </script>
</body>
</html>