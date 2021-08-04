<!-- @if (
    $velocityMetaData
    && $velocityMetaData->subscription_bar_content
    || core()->getConfigData('customer.settings.newsletter.subscription')
)
    <div class="newsletter-subscription">
        <div class="newsletter-wrapper row col-12">
            @if ($velocityMetaData && $velocityMetaData->subscription_bar_content)
                {!! $velocityMetaData->subscription_bar_content !!}
            @endif

            @if (core()->getConfigData('customer.settings.newsletter.subscription'))
                <div class="subscribe-newsletter col-lg-6">
                    <div class="form-container">
                        <form action="{{ route('shop.subscribe') }}">
                            <div class="subscriber-form-div">
                                <div class="control-group">
                                    <input
                                        type="email"
                                        name="subscriber_email"
                                        class="control subscribe-field"
                                        placeholder="{{ __('velocity::app.customer.login-form.your-email-address') }}"
                                        aria-label="Newsletter"
                                        required />

                                    <button class="theme-btn subscribe-btn fw6">
                                        {{ __('shop::app.subscription.subscribe') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endif -->
<div class="footer_media">
    <div class="auto__container">
        <div class="media_wrap">
            <div class="social__icons">
                <a href="#" class="media_item facebook">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="79.999" viewBox="0 0 80 79.999">
                        <g id="facebook" transform="translate(0 0)">
                            <path id="Subtraction_1" data-name="Subtraction 1" d="M-2200-2823a39.752,39.752,0,0,1-15.57-3.143,39.869,39.869,0,0,1-12.715-8.572,39.865,39.865,0,0,1-8.573-12.714A39.747,39.747,0,0,1-2240-2863a39.747,39.747,0,0,1,3.144-15.57,39.863,39.863,0,0,1,8.573-12.714,39.869,39.869,0,0,1,12.715-8.572A39.752,39.752,0,0,1-2200-2903a39.752,39.752,0,0,1,15.57,3.143,39.862,39.862,0,0,1,12.714,8.572,39.868,39.868,0,0,1,8.572,12.714A39.752,39.752,0,0,1-2160-2863a39.752,39.752,0,0,1-3.143,15.57,39.868,39.868,0,0,1-8.572,12.714,39.862,39.862,0,0,1-12.714,8.572A39.752,39.752,0,0,1-2200-2823Zm-7.9-38.434v26.149h10.813v-26.149h7.138l.945-9.181h-8.082v-5.409a2.209,2.209,0,0,1,2.294-2.5h5.812v-8.92l-8.011-.033c-8.044,0-10.91,5.637-10.91,10.912v5.946h-5.144v9.19Z" transform="translate(2240 2903)" fill="#fff" />
                        </g>
                    </svg>
                </a>
                <a href="#" class="media_item imo">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 80 80">
                        <path id="Subtraction_5" data-name="Subtraction 5" d="M40,80A40.011,40.011,0,0,1,24.43,3.143a40.01,40.01,0,0,1,31.14,73.713A39.749,39.749,0,0,1,40,80ZM25.933,61.388h0a25.872,25.872,0,1,0-8-8.738.968.968,0,0,1,.136.685c-.073.754-.711,2.091-3.336,4.185a2.27,2.27,0,0,0-1.082,2.38c.392,1.377,2.347,2.326,3.986,2.52a14.661,14.661,0,0,0,1.654.08c2.25,0,5.174-.344,6.635-1.113Zm14.594,1.033a22.149,22.149,0,0,1-13.763-4.768c-.045,0-.234.045-.521.113a25.065,25.065,0,0,1-5.235.785,5.72,5.72,0,0,1-1.787-.235,5.964,5.964,0,0,0,2.543-4.357,5.65,5.65,0,0,0-.261-2.244A22.249,22.249,0,1,1,40.527,62.421ZM52.589,36.776a4.647,4.647,0,0,0-4.977,4.941,4.56,4.56,0,0,0,4.824,4.809,4.692,4.692,0,0,0,4.921-4.98A4.515,4.515,0,0,0,52.589,36.776ZM40.88,39.1c.9,0,1.373.739,1.373,2.137v4a1.337,1.337,0,0,0,.181.9.52.52,0,0,0,.412.174h1.562c.007,0,.667-.074.667-.993v-4.5c0-2.533-1.176-4.045-3.146-4.045a3.382,3.382,0,0,0-1.774.458,4.157,4.157,0,0,0-1.2,1.125h-.039a2.631,2.631,0,0,0-2.555-1.584,3.224,3.224,0,0,0-2.822,1.47H33.48l-.074-.7a.694.694,0,0,0-.676-.559H31.52a.582.582,0,0,0-.437.159.611.611,0,0,0-.153.4c0,.062.051,1.524.051,2.415v5.36c0,.01.011.994.929.994H33.16a.565.565,0,0,0,.439-.18,1.222,1.222,0,0,0,.205-.813V40.878a1.872,1.872,0,0,1,.115-.725A1.472,1.472,0,0,1,35.273,39.1c.861,0,1.335.7,1.335,1.985v4.235c0,.927.724.993.732.994h1.289a.729.729,0,0,0,.54-.206,1.12,1.12,0,0,0,.263-.709V40.859a2.452,2.452,0,0,1,.114-.744A1.418,1.418,0,0,1,40.88,39.1Zm-15.3-2.118a.588.588,0,0,0-.589.6V45.6c0,.681.505.72.51.72h1.718a.6.6,0,0,0,.454-.178,1.017,1.017,0,0,0,.216-.66V37.7a.655.655,0,0,0-.63-.716Zm.86-4.854a1.568,1.568,0,0,0-1.139.439,1.409,1.409,0,0,0-.387,1.03,1.385,1.385,0,0,0,.388,1.011,1.541,1.541,0,0,0,1.119.44,1.463,1.463,0,1,0,.019-2.92ZM52.512,44.446a1.63,1.63,0,0,1-1.418-.8,3.724,3.724,0,0,1-.489-2c0-1.356.5-2.8,1.907-2.8,1.365,0,1.85,1.511,1.85,2.8C54.362,43.345,53.636,44.446,52.512,44.446Z" fill="#fff" />
                    </svg>
                </a>
                <a href="#" class="media_item instagram">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 80 80">
                        <path id="Subtraction_4" data-name="Subtraction 4" d="M40,80A40.011,40.011,0,0,1,24.43,3.143a40.01,40.01,0,0,1,31.14,73.713A39.749,39.749,0,0,1,40,80Zm-.155-66.693c-7.165,0-8.107.03-10.941.159A19.618,19.618,0,0,0,22.462,14.7,13.575,13.575,0,0,0,14.7,22.461,19.635,19.635,0,0,0,13.468,28.9c-.13,2.831-.16,3.772-.16,10.941s.031,8.112.16,10.941A19.634,19.634,0,0,0,14.7,57.228a13.57,13.57,0,0,0,7.762,7.761A19.621,19.621,0,0,0,28.9,66.223c2.834.129,3.776.159,10.941.159s8.107-.03,10.941-.159a19.628,19.628,0,0,0,6.441-1.234,13.594,13.594,0,0,0,7.761-7.761,19.584,19.584,0,0,0,1.234-6.442c.129-2.834.159-3.776.159-10.941s-.03-8.107-.159-10.941a19.594,19.594,0,0,0-1.234-6.441A13.573,13.573,0,0,0,57.227,14.7a19.623,19.623,0,0,0-6.441-1.232C47.956,13.338,47.016,13.307,39.845,13.307Zm0,48.294c-7.087,0-7.926-.027-10.723-.155a14.709,14.709,0,0,1-4.927-.913A8.791,8.791,0,0,1,19.156,55.5a14.711,14.711,0,0,1-.913-4.928c-.127-2.8-.154-3.64-.154-10.723s.027-7.923.154-10.724a14.726,14.726,0,0,1,.913-4.927,8.784,8.784,0,0,1,5.037-5.036,14.689,14.689,0,0,1,4.927-.914c2.8-.127,3.64-.154,10.723-.154s7.926.027,10.723.155a14.673,14.673,0,0,1,4.928.913,8.786,8.786,0,0,1,5.036,5.036,14.673,14.673,0,0,1,.913,4.927c.128,2.8.155,3.636.155,10.723,0,7.11-.027,7.946-.155,10.723a14.676,14.676,0,0,1-.913,4.928A8.8,8.8,0,0,1,55.5,60.533a14.709,14.709,0,0,1-4.928.913C47.771,61.574,46.932,61.6,39.845,61.6Zm0-35.384A13.627,13.627,0,1,0,53.472,39.845,13.643,13.643,0,0,0,39.845,26.217Zm14.166-3.722a3.185,3.185,0,1,0,3.184,3.184A3.188,3.188,0,0,0,54.011,22.495Zm-14.166,26.2a8.846,8.846,0,1,1,8.846-8.846A8.857,8.857,0,0,1,39.845,48.691Z" fill="#fff" />
                    </svg>
                </a>
                <a href="#" class="media_item ok">
                    <svg id="odnoklassniki-logo" xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 80 80">
                        <g id="Group_143" data-name="Group 143">
                            <path id="Path_3292" data-name="Path 3292" d="M47.382,37.447a6.895,6.895,0,1,0-6.937-6.826A6.848,6.848,0,0,0,47.382,37.447Z" transform="translate(-7.344 -4.296)" fill="#fff" />
                            <path id="Path_3293" data-name="Path 3293" d="M40,0A40,40,0,1,0,80,40,40,40,0,0,0,40,0Zm.057,12.164A14.089,14.089,0,1,1,25.922,26.222,14.094,14.094,0,0,1,40.057,12.164ZM55.838,45.878a16.933,16.933,0,0,1-6.1,3.941,28.681,28.681,0,0,1-6.925,1.552c.358.388.525.579.748.8,3.2,3.222,6.425,6.428,9.62,9.659a3.182,3.182,0,0,1,.716,3.746,3.794,3.794,0,0,1-3.561,2.22,3.467,3.467,0,0,1-2.254-1.152c-2.419-2.434-4.884-4.825-7.253-7.3-.692-.722-1.022-.584-1.632.043-2.433,2.506-4.906,4.972-7.394,7.425a3.1,3.1,0,0,1-3.743.671,3.785,3.785,0,0,1-2.186-3.488,3.488,3.488,0,0,1,1.174-2.339q4.759-4.75,9.5-9.517c.21-.21.405-.434.71-.761-4.315-.451-8.207-1.513-11.539-4.118a15.255,15.255,0,0,1-1.217-1,3.458,3.458,0,0,1,3.914-5.636,6.766,6.766,0,0,1,.956.564,18.917,18.917,0,0,0,20.971.191,5.687,5.687,0,0,1,2.043-1.055,3.2,3.2,0,0,1,3.671,1.466A3.11,3.11,0,0,1,55.838,45.878Z" fill="#fff" />
                        </g>
                    </svg>
                </a>
                <a href="#" class="media_item telegram">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="79.999" viewBox="0 0 80 79.999">
                        <g id="telegram" transform="translate(0 0)">
                            <path id="Subtraction_3" data-name="Subtraction 3" d="M-2392-2823a39.752,39.752,0,0,1-15.57-3.143,39.868,39.868,0,0,1-12.714-8.572,39.868,39.868,0,0,1-8.572-12.714A39.752,39.752,0,0,1-2432-2863a39.752,39.752,0,0,1,3.143-15.57,39.868,39.868,0,0,1,8.572-12.714,39.868,39.868,0,0,1,12.714-8.572A39.752,39.752,0,0,1-2392-2903a39.754,39.754,0,0,1,15.57,3.143,39.871,39.871,0,0,1,12.714,8.572,39.863,39.863,0,0,1,8.573,12.714A39.747,39.747,0,0,1-2352-2863a39.747,39.747,0,0,1-3.144,15.57,39.863,39.863,0,0,1-8.573,12.714,39.871,39.871,0,0,1-12.714,8.572A39.754,39.754,0,0,1-2392-2823Zm-.533-27.336h0l10,7.37a3.362,3.362,0,0,0,1.61.508c.991,0,1.684-.761,2-2.2l6.566-30.937,0,0a3.062,3.062,0,0,0-.36-2.677,1.78,1.78,0,0,0-1.44-.647,2.871,2.871,0,0,0-.973.182l-38.567,14.87c-1.307.511-2.045,1.175-2.024,1.822.018.55.59,1.044,1.571,1.355l9.874,3.08,22.9-14.42a2.019,2.019,0,0,1,1.057-.37c.241,0,.416.08.466.215.057.151-.043.35-.281.559l-18.533,16.744-.71,10.176a2.532,2.532,0,0,0,2.017-.984l4.823-4.646Z" transform="translate(2432 2903)" fill="#fff" />
                        </g>
                    </svg>
                </a>
                <a href="#" class="media_item vk">
                    <svg xmlns="http://www.w3.org/2000/svg" width="79.999" height="79.999" viewBox="0 0 79.999 79.999">
                        <g id="vk" transform="translate(0 0)">
                            <path id="Subtraction_2" data-name="Subtraction 2" d="M-2296-2823a39.752,39.752,0,0,1-15.57-3.143,39.868,39.868,0,0,1-12.714-8.572,39.868,39.868,0,0,1-8.572-12.714A39.752,39.752,0,0,1-2336-2863a39.752,39.752,0,0,1,3.143-15.57,39.868,39.868,0,0,1,8.572-12.714,39.868,39.868,0,0,1,12.714-8.572A39.752,39.752,0,0,1-2296-2903a39.752,39.752,0,0,1,15.57,3.143,39.862,39.862,0,0,1,12.714,8.572,39.872,39.872,0,0,1,8.572,12.714A39.752,39.752,0,0,1-2256-2863a39.752,39.752,0,0,1-3.143,15.57,39.872,39.872,0,0,1-8.572,12.714,39.859,39.859,0,0,1-12.714,8.572A39.752,39.752,0,0,1-2296-2823Zm5.742-29.349c1.083,0,2.331,1.43,3.651,2.944a18.089,18.089,0,0,0,3.019,2.983,5.543,5.543,0,0,0,3.1,1.092,2.275,2.275,0,0,0,.391-.028l7.014-.1c.017,0,1.735-.125,2.249-1.1a2.041,2.041,0,0,0-.319-2.008c-.01-.017-.024-.042-.043-.076a28.516,28.516,0,0,0-5.172-5.958l-.124-.115c-3.717-3.449-3.717-3.449-.178-8.026l.02-.026c.518-.671,1.106-1.431,1.771-2.317,3.143-4.189,4.526-6.9,4.113-8.05-.257-.715-1.418-.822-2.088-.822a6.465,6.465,0,0,0-.667.033l-7.9.05a1.792,1.792,0,0,0-.215-.012,1.607,1.607,0,0,0-.8.191,2.219,2.219,0,0,0-.7.848,45.967,45.967,0,0,1-2.917,6.158c-2.931,4.977-4.409,6.022-5.132,6.022a.665.665,0,0,1-.366-.105c-1.12-.724-1.067-2.664-1.021-4.375.009-.317.018-.642.018-.95,0-1.332.046-2.472.086-3.477.135-3.341.2-4.866-1.8-5.347a13.563,13.563,0,0,0-3.687-.366c-.447,0-.814-.007-1.155-.007-2.086,0-4.184.082-5.4.677-.71.348-1.342,1.077-1.294,1.368a.128.128,0,0,0,.125.109,3.569,3.569,0,0,1,2.331,1.173c.8,1.082.781,3.549.781,3.574,0,.068.445,6.822-1.086,7.658a1.033,1.033,0,0,1-.506.134c-1.115,0-2.656-1.841-5.154-6.156a50.7,50.7,0,0,1-2.819-5.843,2.36,2.36,0,0,0-.652-.881,3.282,3.282,0,0,0-1.213-.49l-7.505.05c-.011,0-1.131.037-1.54.521-.365.433-.033,1.327-.03,1.336.059.137,5.949,13.823,12.529,20.674a18.4,18.4,0,0,0,12.759,5.939c.149,0,.241,0,.266-.006h3.142a2.672,2.672,0,0,0,1.432-.626,2.3,2.3,0,0,0,.431-1.379c0-.042-.027-4.224,1.895-4.833A1.17,1.17,0,0,1-2290.258-2852.349Z" transform="translate(2336 2903)" fill="#fff" />
                        </g>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>