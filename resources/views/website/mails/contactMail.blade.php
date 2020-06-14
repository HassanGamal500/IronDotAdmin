<div class="card-body">
    @if($contact_us_subject)
	    <div class="subject">
	        <h2><span style='color:red;'>Subject</span></h2>
	        <div class="subject-div">
	            <h4>{{ $contact_us_subject }}</h4>
	        </div>
	    </div>
    @endif
    @if($contact_us_name)
	    <div class="name">
	        <h2><span style='color:red;'>Name</span></h2>
	        <div class="name-div">
	            <h4>{{ $contact_us_name }}</h4>
	        </div>
	    </div>
    @endif
    @if($contact_us_phone)
	    <div class="name">
	        <h2><span style='color:red;'>Phone</span></h2>
	        <div class="phone-div">
	            <h4>{{ $contact_us_phone }}</h4>
	        </div>
	    </div>
    @endif
    @if($contact_us_email)
	    <div class="email">
	        <h2><span style='color:red;'>Email Address</span></h2>
	        <div class="email-div">
	            <h4>{{ $contact_us_email }}</h4>
	        </div>
	    </div>
    @endif
    @if($website_url)
	    <div class="website_url">
	        <h2><span style='color:red;'>Website Url</span></h2>
	        <div class="website_url-div">
	            <h4><a href="{{$website_url}}">{{$website_url}}</a></h4>
	        </div>
	    </div>
    @endif
    @if($services_name)
	    <div class="services">
	        <h2><span style='color:red;'>Services</span></h2>
	        <div class="services-div">
	            <h4>{{ $services_name }}</h4>
	        </div>
	    </div>
    @endif
    @if($contact_us_message)
	    <div class="message">
	        <h2><span style='color:red;'>Message</span></h2>
	        <div class="message-div">
	            <h4>{{ $contact_us_message }}</h4>
	        </div>
	    </div>
    @endif
</div>