@extends('layouts.app')

@section('content')
<div class="bg-white">
    <!-- Header -->
    <div class="bg-gray-50 border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-gray-900">Privacy Policy</h1>
                <p class="mt-2 text-sm text-gray-600">
                    Last updated: {{ date('F j, Y') }}
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="prose prose-lg max-w-none">
            <h2>1. Introduction</h2>
            <p>
                MedTools ("we," "our," or "us") is committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you use our e-commerce platform for medical tools and equipment.
            </p>

            <h2>2. Information We Collect</h2>
            
            <h3>2.1 Personal Information</h3>
            <p>We may collect the following personal information:</p>
            <ul>
                <li>Name and contact information (email, phone, address)</li>
                <li>Account credentials</li>
                <li>Payment information (processed securely through our payment gateway)</li>
                <li>Order history and preferences</li>
                <li>Communication records with our support team</li>
            </ul>

            <h3>2.2 Automatically Collected Information</h3>
            <p>We automatically collect certain information when you use our Platform:</p>
            <ul>
                <li>IP address and device information</li>
                <li>Browser type and version</li>
                <li>Operating system</li>
                <li>Pages visited and time spent</li>
                <li>Referring website</li>
                <li>Cookies and similar technologies</li>
            </ul>

            <h2>3. How We Use Your Information</h2>
            <p>We use the collected information for the following purposes:</p>
            <ul>
                <li>Process and fulfill your orders</li>
                <li>Provide customer support</li>
                <li>Send order confirmations and updates</li>
                <li>Improve our Platform and services</li>
                <li>Send marketing communications (with your consent)</li>
                <li>Prevent fraud and ensure security</li>
                <li>Comply with legal obligations</li>
            </ul>

            <h2>4. Information Sharing</h2>
            <p>We may share your information in the following circumstances:</p>
            
            <h3>4.1 With Vendors</h3>
            <p>When you place an order, we share necessary information with the vendor to fulfill your order, including:</p>
            <ul>
                <li>Your name and shipping address</li>
                <li>Order details</li>
                <li>Contact information for order updates</li>
            </ul>

            <h3>4.2 Service Providers</h3>
            <p>We may share information with trusted service providers who assist us in:</p>
            <ul>
                <li>Payment processing</li>
                <li>Website hosting and maintenance</li>
                <li>Email communications</li>
                <li>Analytics and marketing</li>
            </ul>

            <h3>4.3 Legal Requirements</h3>
            <p>We may disclose your information if required by law or to protect our rights and safety.</p>

            <h2>5. Data Security</h2>
            <p>
                We implement appropriate security measures to protect your personal information, including:
            </p>
            <ul>
                <li>Encryption of sensitive data</li>
                <li>Secure payment processing</li>
                <li>Regular security assessments</li>
                <li>Access controls and authentication</li>
                <li>Data backup and recovery procedures</li>
            </ul>

            <h2>6. Cookies and Tracking Technologies</h2>
            <p>
                We use cookies and similar technologies to enhance your experience on our Platform. These technologies help us:
            </p>
            <ul>
                <li>Remember your preferences</li>
                <li>Analyze website traffic</li>
                <li>Provide personalized content</li>
                <li>Improve our services</li>
            </ul>
            <p>
                You can control cookie settings through your browser preferences.
            </p>

            <h2>7. Your Rights and Choices</h2>
            <p>You have the following rights regarding your personal information:</p>
            
            <h3>7.1 Access and Update</h3>
            <p>You can access and update your personal information through your account settings.</p>

            <h3>7.2 Opt-out of Marketing</h3>
            <p>You can opt-out of marketing communications by following the unsubscribe instructions in our emails or contacting us directly.</p>

            <h3>7.3 Data Deletion</h3>
            <p>You may request deletion of your account and associated data, subject to legal and contractual obligations.</p>

            <h3>7.4 Data Portability</h3>
            <p>You may request a copy of your personal information in a portable format.</p>

            <h2>8. Data Retention</h2>
            <p>
                We retain your personal information for as long as necessary to provide our services and comply with legal obligations. 
                Account information is retained while your account is active and for a reasonable period after deactivation.
            </p>

            <h2>9. Children's Privacy</h2>
            <p>
                Our Platform is not intended for children under 13 years of age. We do not knowingly collect personal information from children under 13. 
                If you believe we have collected information from a child under 13, please contact us immediately.
            </p>

            <h2>10. International Data Transfers</h2>
            <p>
                Your information may be transferred to and processed in countries other than your own. We ensure appropriate safeguards are in place to protect your information during such transfers.
            </p>

            <h2>11. Third-Party Links</h2>
            <p>
                Our Platform may contain links to third-party websites. We are not responsible for the privacy practices of these websites. 
                We encourage you to review their privacy policies before providing any personal information.
            </p>

            <h2>12. Changes to This Policy</h2>
            <p>
                We may update this Privacy Policy from time to time. We will notify you of any material changes by posting the new policy on our Platform 
                and updating the "Last updated" date. Your continued use of our Platform after such changes constitutes acceptance of the updated policy.
            </p>

            <h2>13. Contact Us</h2>
            <p>
                If you have any questions about this Privacy Policy or our privacy practices, please contact us:
            </p>
            <ul>
                <li>Email: privacy@medtools.com</li>
                <li>Phone: +1 (555) 123-4567</li>
                <li>Address: 123 Medical Plaza, Suite 456, Healthcare City, HC 12345</li>
            </ul>

            <h2>14. Data Protection Officer</h2>
            <p>
                For privacy-related inquiries, you may also contact our Data Protection Officer at dpo@medtools.com.
            </p>

            <div class="mt-8 p-4 bg-blue-50 rounded-lg">
                <h3 class="text-lg font-semibold text-blue-900 mb-2">Your Privacy Matters</h3>
                <p class="text-blue-800">
                    We are committed to protecting your privacy and ensuring the security of your personal information. 
                    If you have any concerns about how we handle your data, please don't hesitate to contact us.
                </p>
            </div>

            <div class="mt-8 p-4 bg-gray-50 rounded-lg">
                <p class="text-sm text-gray-600">
                    <strong>Note:</strong> This Privacy Policy applies to all users of the MedTools Platform. 
                    By using our services, you acknowledge that you have read and understood this policy.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection 