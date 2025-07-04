@extends('layouts.app')

@section('content')
<div class="bg-white">
    <!-- Header -->
    <div class="bg-gray-50 border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-gray-900">Terms of Service</h1>
                <p class="mt-2 text-sm text-gray-600">
                    Last updated: {{ date('F j, Y') }}
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="prose prose-lg max-w-none">
            <h2>1. Acceptance of Terms</h2>
            <p>
                By accessing and using MedTools ("the Platform"), you accept and agree to be bound by the terms and provision of this agreement. 
                If you do not agree to abide by the above, please do not use this service.
            </p>

            <h2>2. Description of Service</h2>
            <p>
                MedTools is an e-commerce platform that connects healthcare professionals with vendors of medical tools and equipment. 
                The Platform facilitates the buying and selling of medical products through a secure online marketplace.
            </p>

            <h2>3. User Accounts</h2>
            <p>
                To access certain features of the Platform, you must create an account. You are responsible for:
            </p>
            <ul>
                <li>Maintaining the confidentiality of your account information</li>
                <li>All activities that occur under your account</li>
                <li>Providing accurate and complete information</li>
                <li>Notifying us immediately of any unauthorized use</li>
            </ul>

            <h2>4. User Roles and Responsibilities</h2>
            
            <h3>4.1 Customers</h3>
            <p>As a customer, you agree to:</p>
            <ul>
                <li>Provide accurate shipping and billing information</li>
                <li>Pay for orders in full at the time of purchase</li>
                <li>Review product details before making purchases</li>
                <li>Contact vendors directly for product-specific questions</li>
                <li>Follow all applicable laws and regulations</li>
            </ul>

            <h3>4.2 Vendors</h3>
            <p>As a vendor, you agree to:</p>
            <ul>
                <li>Provide accurate product information and images</li>
                <li>Maintain adequate inventory levels</li>
                <li>Process orders promptly and ship within stated timeframes</li>
                <li>Provide quality products that meet healthcare standards</li>
                <li>Comply with all applicable laws and regulations</li>
                <li>Maintain proper business licenses and certifications</li>
            </ul>

            <h2>5. Product Information and Quality</h2>
            <p>
                While we strive to ensure accurate product information, we do not guarantee the accuracy, completeness, or reliability of any product information. 
                Vendors are responsible for the accuracy of their product listings. Customers should verify product specifications before making purchases.
            </p>

            <h2>6. Payment and Pricing</h2>
            <p>
                All prices are listed in USD unless otherwise specified. Payment is processed securely through our payment gateway. 
                Prices may change without notice. Sales tax will be applied where applicable.
            </p>

            <h2>7. Shipping and Delivery</h2>
            <p>
                Shipping times and costs are determined by vendors and shipping carriers. We are not responsible for delays caused by shipping carriers or circumstances beyond our control.
            </p>

            <h2>8. Returns and Refunds</h2>
            <p>
                Return policies are set by individual vendors. Customers should review vendor return policies before making purchases. 
                We will facilitate communication between customers and vendors regarding returns and refunds.
            </p>

            <h2>9. Prohibited Activities</h2>
            <p>You agree not to:</p>
            <ul>
                <li>Use the Platform for any illegal or unauthorized purpose</li>
                <li>Violate any applicable laws or regulations</li>
                <li>Infringe on intellectual property rights</li>
                <li>Attempt to gain unauthorized access to the Platform</li>
                <li>Interfere with the proper functioning of the Platform</li>
                <li>Provide false or misleading information</li>
                <li>Engage in fraudulent activities</li>
            </ul>

            <h2>10. Intellectual Property</h2>
            <p>
                The Platform and its content are protected by intellectual property laws. You may not copy, reproduce, distribute, or create derivative works without our written permission.
            </p>

            <h2>11. Privacy Policy</h2>
            <p>
                Your privacy is important to us. Please review our Privacy Policy, which also governs your use of the Platform.
            </p>

            <h2>12. Disclaimers</h2>
            <p>
                THE PLATFORM IS PROVIDED "AS IS" WITHOUT WARRANTIES OF ANY KIND. WE DISCLAIM ALL WARRANTIES, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, AND NON-INFRINGEMENT.
            </p>

            <h2>13. Limitation of Liability</h2>
            <p>
                IN NO EVENT SHALL MEDTOOLS BE LIABLE FOR ANY INDIRECT, INCIDENTAL, SPECIAL, CONSEQUENTIAL, OR PUNITIVE DAMAGES ARISING OUT OF OR RELATING TO YOUR USE OF THE PLATFORM.
            </p>

            <h2>14. Indemnification</h2>
            <p>
                You agree to indemnify and hold harmless MedTools from any claims, damages, or expenses arising from your use of the Platform or violation of these terms.
            </p>

            <h2>15. Termination</h2>
            <p>
                We may terminate or suspend your account at any time for violations of these terms or for any other reason at our sole discretion.
            </p>

            <h2>16. Governing Law</h2>
            <p>
                These terms shall be governed by and construed in accordance with the laws of the United States, without regard to conflict of law principles.
            </p>

            <h2>17. Changes to Terms</h2>
            <p>
                We reserve the right to modify these terms at any time. Changes will be effective immediately upon posting. Your continued use of the Platform constitutes acceptance of the modified terms.
            </p>

            <h2>18. Contact Information</h2>
            <p>
                If you have any questions about these Terms of Service, please contact us at:
            </p>
            <ul>
                <li>Email: legal@medtools.com</li>
                <li>Phone: +1 (555) 123-4567</li>
                <li>Address: 123 Medical Plaza, Suite 456, Healthcare City, HC 12345</li>
            </ul>

            <div class="mt-8 p-4 bg-gray-50 rounded-lg">
                <p class="text-sm text-gray-600">
                    <strong>Note:</strong> These terms are a legal agreement between you and MedTools. 
                    Please read them carefully before using our Platform. If you do not agree to these terms, 
                    please do not use our services.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection 