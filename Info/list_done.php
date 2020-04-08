REFACTORING

TODO for all status to change in int

User Management
• ++Permissions - User Permission List • ++Roles - Individual User Role Type List • +-All Users - List of All Users (users)
mobile_no varchar [unique]
user_type - am pus roles
country_code- am pus countries
referred_by varchar [ref: > USER.referral_code] // code who referrer user • ++Admin Users - All Admin Users List (admin_users) • Logs - Audit Logs

Customer Management
• -Customers List - All Customer List (select from users) • +-Customer Meta - User Meta (users_meta)
user_wishlist - cei cu asta ? • ++Wallet History - User Wallet History (user_wallet_history) • Reviews - User Reviews on Video (user_review)
•  ++Reviews
stars - de pus int 1 to 5
video_id varchar [ref: > artist_response.video_id] - am pus simple video_id


Artist Management
• -Artist List - All Artist List (select from users) • +-Artist Meta - Artist Public Profile Information (artist_meta)
artist_id - ar fi de dorit sa fie
languages - am multi relatie
main_catogery,sub_catogeries am pus relatie
Tags - multi relatie
• +-Artist Enquiry - New Artist Enquiry Info (artists_eqnuiry)
social_media_type varchar // Social Media type fb etc - nafiga este social media ?
social_media_id varchar // Social media id or url- nafiga este social media ?
social_media_followrs varchar // no of followers- nafiga este social media ?
country_code- am pus legatura cu country
artist_id - am adaugat artist ID

Agent Mangement
• -Agent List - All agent list (select from users)
• ++Agent Meta - Agent Details (agent_meta)
agent_id int [ref: > USER.id] // agent user id


Media Management
• User Profile Avatar Images
• Talent Profile Images • Talent Profile Intro Videos
• Order Videos


Order Management
• +-Order History (order) ( artist_id) trebuie de adaugat
artist_id int [ref: > ARTIST.artist_id] // id of artist who need to make video — am pus artist meta
user_id int [ref: > USER.id] // user id who ordered video
language - am pus multi legatura • ++Order Payment(order_payment) • +-Artist Response (artist_response)
artist_id int [ref: > order.artist_id] // artist id who take action — am pus artist meta


+Payment Management
• ++Artist Payment - Artist Earning History from Video and Referral (artist_payment_history)
• ++Agent Payment Agent Earning History from Talent Referral (agent_payment_history)

Site Logs
• ++Search Log (search_log) •++Login Log - Each user login log (login_log) • +_Payment Log - This data we will get from payment gateway and we will store it

++Content Management
• ++Main Categories (catogery) • ++Sub Categories (sub_catogery) • Tags (tags) • ++Countries (countries) • ++Languages (languages) • ++Social Media (social_media) • ++Gender (gender) • ++Occasion List

++Site Management
• ++Site Settings (admin settings) store in rows
•++Web Page Content • ++Email Subscriptions (email_subscription) • ++Promo Codes (promo_codes)
++Change Password / Logout


