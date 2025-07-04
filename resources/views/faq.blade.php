@extends('layouts.app')

@section('content')
<div class="bg-white">
    <!-- Header -->
    <div class="bg-gray-50 border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-gray-900">Frequently Asked Questions</h1>
                <p class="mt-2 text-sm text-gray-600">
                    Find answers to common questions about our medical tools platform
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Search FAQ -->
        <div class="mb-8">
            <div class="relative">
                <input type="text" id="faq-search" 
                       placeholder="Search FAQ..." 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- FAQ Categories -->
        <div class="space-y-8">
            <!-- General Questions -->
            <div class="faq-category">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">General Questions</h2>
                <div class="space-y-4">
                    <div class="faq-item bg-white border border-gray-200 rounded-lg">
                        <button class="faq-question w-full px-6 py-4 text-left focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <div class="flex items-center justify-between">
                                <span class="font-medium text-gray-900">What is MedTools?</span>
                                <svg class="faq-icon w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4">
                            <p class="text-gray-600">
                                MedTools is an e-commerce platform that connects healthcare professionals with verified vendors of medical tools and equipment. 
                                We provide a secure marketplace for buying and selling high-quality medical products.
                            </p>
                        </div>
                    </div>

                    <div class="faq-item bg-white border border-gray-200 rounded-lg">
                        <button class="faq-question w-full px-6 py-4 text-left focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <div class="flex items-center justify-between">
                                <span class="font-medium text-gray-900">How do I create an account?</span>
                                <svg class="faq-icon w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4">
                            <p class="text-gray-600">
                                You can create an account by clicking the "Register" button in the top navigation. 
                                Fill out the registration form with your information and verify your email address to get started.
                            </p>
                        </div>
                    </div>

                    <div class="faq-item bg-white border border-gray-200 rounded-lg">
                        <button class="faq-question w-full px-6 py-4 text-left focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <div class="flex items-center justify-between">
                                <span class="font-medium text-gray-900">Is my information secure?</span>
                                <svg class="faq-icon w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4">
                            <p class="text-gray-600">
                                Yes, we take security seriously. All personal and payment information is encrypted and processed securely. 
                                We use industry-standard security measures to protect your data. Read our Privacy Policy for more details.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shopping & Orders -->
            <div class="faq-category">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Shopping & Orders</h2>
                <div class="space-y-4">
                    <div class="faq-item bg-white border border-gray-200 rounded-lg">
                        <button class="faq-question w-full px-6 py-4 text-left focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <div class="flex items-center justify-between">
                                <span class="font-medium text-gray-900">How do I place an order?</span>
                                <svg class="faq-icon w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4">
                            <p class="text-gray-600">
                                Browse our products, add items to your cart, and proceed to checkout. You'll need to be logged in to complete your purchase. 
                                Follow the checkout process to provide shipping and payment information.
                            </p>
                        </div>
                    </div>

                    <div class="faq-item bg-white border border-gray-200 rounded-lg">
                        <button class="faq-question w-full px-6 py-4 text-left focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <div class="flex items-center justify-between">
                                <span class="font-medium text-gray-900">What payment methods do you accept?</span>
                                <svg class="faq-icon w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4">
                            <p class="text-gray-600">
                                We accept all major credit cards (Visa, MasterCard, American Express), debit cards, and digital wallets through our secure Midtrans payment gateway.
                            </p>
                        </div>
                    </div>

                    <div class="faq-item bg-white border border-gray-200 rounded-lg">
                        <button class="faq-question w-full px-6 py-4 text-left focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <div class="flex items-center justify-between">
                                <span class="font-medium text-gray-900">How long does shipping take?</span>
                                <svg class="faq-icon w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4">
                            <p class="text-gray-600">
                                Shipping times vary by vendor and location. Standard shipping typically takes 3-5 business days. 
                                Express shipping options are available for faster delivery. You'll receive tracking information once your order ships.
                            </p>
                        </div>
                    </div>

                    <div class="faq-item bg-white border border-gray-200 rounded-lg">
                        <button class="faq-question w-full px-6 py-4 text-left focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <div class="flex items-center justify-between">
                                <span class="font-medium text-gray-900">Can I cancel or modify my order?</span>
                                <svg class="faq-icon w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4">
                            <p class="text-gray-600">
                                Orders can typically be cancelled or modified within 1 hour of placement, before they are processed by the vendor. 
                                Contact our support team immediately if you need to make changes to your order.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Returns & Refunds -->
            <div class="faq-category">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Returns & Refunds</h2>
                <div class="space-y-4">
                    <div class="faq-item bg-white border border-gray-200 rounded-lg">
                        <button class="faq-question w-full px-6 py-4 text-left focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <div class="flex items-center justify-between">
                                <span class="font-medium text-gray-900">What is your return policy?</span>
                                <svg class="faq-icon w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4">
                            <p class="text-gray-600">
                                Return policies are set by individual vendors. Most vendors accept returns within 30 days of delivery for unused items in original packaging. 
                                Check the vendor's return policy before making a purchase.
                            </p>
                        </div>
                    </div>

                    <div class="faq-item bg-white border border-gray-200 rounded-lg">
                        <button class="faq-question w-full px-6 py-4 text-left focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <div class="flex items-center justify-between">
                                <span class="font-medium text-gray-900">How do I request a refund?</span>
                                <svg class="faq-icon w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4">
                            <p class="text-gray-600">
                                Contact our support team to initiate a refund request. We'll work with the vendor to process your refund. 
                                Refunds are typically processed within 5-10 business days.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vendor Questions -->
            <div class="faq-category">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">For Vendors</h2>
                <div class="space-y-4">
                    <div class="faq-item bg-white border border-gray-200 rounded-lg">
                        <button class="faq-question w-full px-6 py-4 text-left focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <div class="flex items-center justify-between">
                                <span class="font-medium text-gray-900">How do I become a vendor?</span>
                                <svg class="faq-icon w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4">
                            <p class="text-gray-600">
                                Click "Become a Vendor" in the navigation menu and fill out the registration form. 
                                Our team will review your application and get back to you within 2-3 business days.
                            </p>
                        </div>
                    </div>

                    <div class="faq-item bg-white border border-gray-200 rounded-lg">
                        <button class="faq-question w-full px-6 py-4 text-left focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <div class="flex items-center justify-between">
                                <span class="font-medium text-gray-900">What are the vendor fees?</span>
                                <svg class="faq-icon w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4">
                            <p class="text-gray-600">
                                We charge a small commission fee on each sale. The exact percentage varies based on your sales volume and product category. 
                                Contact us for detailed pricing information.
                            </p>
                        </div>
                    </div>

                    <div class="faq-item bg-white border border-gray-200 rounded-lg">
                        <button class="faq-question w-full px-6 py-4 text-left focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <div class="flex items-center justify-between">
                                <span class="font-medium text-gray-900">How do I manage my products?</span>
                                <svg class="faq-icon w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4">
                            <p class="text-gray-600">
                                Once approved, you'll have access to your vendor dashboard where you can add, edit, and manage your products, 
                                view orders, and track your sales performance.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Technical Support -->
            <div class="faq-category">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Technical Support</h2>
                <div class="space-y-4">
                    <div class="faq-item bg-white border border-gray-200 rounded-lg">
                        <button class="faq-question w-full px-6 py-4 text-left focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <div class="flex items-center justify-between">
                                <span class="font-medium text-gray-900">I forgot my password. How do I reset it?</span>
                                <svg class="faq-icon w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4">
                            <p class="text-gray-600">
                                Click "Forgot Password" on the login page and enter your email address. 
                                We'll send you a link to reset your password.
                            </p>
                        </div>
                    </div>

                    <div class="faq-item bg-white border border-gray-200 rounded-lg">
                        <button class="faq-question w-full px-6 py-4 text-left focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <div class="flex items-center justify-between">
                                <span class="font-medium text-gray-900">How do I contact customer support?</span>
                                <svg class="faq-icon w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4">
                            <p class="text-gray-600">
                                You can contact us through our Contact page, email us at support@medtools.com, 
                                or call us at +1 (555) 123-4567 during business hours.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Support -->
        <div class="mt-12 bg-blue-50 rounded-lg p-6">
            <h2 class="text-xl font-semibold text-blue-900 mb-4">Still have questions?</h2>
            <p class="text-blue-800 mb-4">
                If you couldn't find the answer you're looking for, our support team is here to help.
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('contact') }}" 
                   class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 text-center">
                    Contact Support
                </a>
                <a href="mailto:support@medtools.com" 
                   class="bg-white text-blue-600 px-6 py-2 rounded-md border border-blue-600 hover:bg-blue-50 text-center">
                    Email Us
                </a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // FAQ Toggle functionality
    const faqQuestions = document.querySelectorAll('.faq-question');
    
    faqQuestions.forEach(question => {
        question.addEventListener('click', function() {
            const answer = this.nextElementSibling;
            const icon = this.querySelector('.faq-icon');
            
            // Toggle answer visibility
            answer.classList.toggle('hidden');
            
            // Rotate icon
            icon.style.transform = answer.classList.contains('hidden') ? 'rotate(0deg)' : 'rotate(180deg)';
        });
    });

    // FAQ Search functionality
    const searchInput = document.getElementById('faq-search');
    const faqItems = document.querySelectorAll('.faq-item');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question').textContent.toLowerCase();
            const answer = item.querySelector('.faq-answer').textContent.toLowerCase();
            
            if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
});
</script>
@endsection 