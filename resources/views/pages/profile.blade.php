@extends('pages.dashboard.app')
@section('title', 'Profile Settings')
@push('styles')
<style>
.profile-page{display:grid;gap:23px}.profile-heading{display:flex;align-items:flex-end;justify-content:space-between;gap:18px;flex-wrap:wrap}.profile-kicker{font-size:10px;letter-spacing:.16em;font-weight:800;color:var(--teal)}.profile-heading h1{font-size:clamp(27px,3vw,36px);letter-spacing:-.055em;line-height:1.15;margin-top:5px}.profile-heading p{font-size:13px;color:var(--muted);margin-top:8px}.profile-hero{display:flex;align-items:center;gap:17px;padding:24px;border-radius:16px;background:linear-gradient(115deg,#131A28,#1F6A8F);color:#fff}.profile-avatar{width:64px;height:64px;display:grid;place-items:center;flex:none;border-radius:18px;background:#FFFFFF1A;border:1px solid #FFFFFF35;font:800 22px 'Manrope',sans-serif}.profile-hero h2{font-size:20px;letter-spacing:-.04em}.profile-hero p{color:#D4E4ED;font-size:12px;margin-top:4px}.profile-hero .verified{display:inline-flex;margin-top:8px;padding:4px 8px;border-radius:99px;background:#FFFFFF18;color:#D8F4EA;font-size:10px;font-weight:800}.profile-layout{display:grid;grid-template-columns:minmax(0,1.45fr) minmax(280px,.75fr);gap:18px;align-items:start}.profile-card{background:#fff;border:1px solid var(--line);border-radius:15px;overflow:hidden;box-shadow:var(--shadow-sm)}.profile-card-head{padding:20px 22px;border-bottom:1px solid #EAF0F4}.profile-card-head h2{font-size:17px;letter-spacing:-.035em}.profile-card-head p{font-size:12px;color:var(--muted);margin-top:5px}.profile-card-body{padding:21px 22px}.profile-form-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:14px}.profile-field{display:grid;gap:6px;min-width:0}.profile-field.full{grid-column:1/-1}.profile-field label{font-size:11px;font-weight:800;color:#3D556A}.profile-field input,.profile-field select{width:100%;min-width:0;border:1px solid #CBD9E2;background:#fff;border-radius:8px;padding:10px 11px;font-size:12px;color:var(--navy)}.profile-field input:focus,.profile-field select:focus{outline:2px solid #1F6A8F30;border-color:var(--teal)}.profile-section-label{grid-column:1/-1;padding-top:13px;border-top:1px solid #EAF0F4;font-size:10px;letter-spacing:.1em;font-weight:800;color:var(--teal)}.profile-section-label:first-child{border-top:0;padding-top:0}.profile-submit{margin-top:18px;display:flex;justify-content:flex-end}.profile-submit button{border:0;border-radius:8px;background:var(--teal);color:#fff;padding:11px 16px;font-size:12px;font-weight:800}.password-stack{display:grid;gap:13px}.password-hint{font-size:11px;color:var(--muted);line-height:1.6}.security-note{display:flex;gap:10px;padding:13px;background:#F1F7FA;border-radius:9px;color:#496579;font-size:11px;line-height:1.6;margin-top:16px}.security-note svg{color:var(--teal)}.profile-flash{padding:12px 15px;border-radius:9px;background:#E4F6EC;color:#177347;font-size:12px;font-weight:700}.profile-errors{padding:12px 15px;background:#FCEBE9;color:#AD3B32;border-radius:9px;font-size:12px}.profile-errors ul{padding-left:18px}.required-note{font-size:10px;color:var(--muted);margin-top:12px}@media(max-width:950px){.profile-layout{grid-template-columns:1fr}}@media(max-width:560px){.profile-form-grid{grid-template-columns:1fr}.profile-field.full,.profile-section-label{grid-column:auto}.profile-card-body,.profile-card-head{padding:17px}.profile-hero{padding:18px}.profile-avatar{width:54px;height:54px}}
</style>
@endpush
@section('content')
@php
$user = auth()->user();
$initials = collect([$user->first_name, $user->surname])->filter()->map(fn($n)=>mb_substr($n,0,1))->implode('');
@endphp
<div class="profile-page">
    <header class="profile-heading"><div><span class="profile-kicker">ACCOUNT & PERSONAL DETAILS</span><h1>Profile settings</h1><p>Keep your information accurate so your scholarship applications are easier to manage.</p></div></header>
    @if(session('status'))<div class="profile-flash" role="status">{{ session('status') }}</div>@endif
    @if($errors->any())<div class="profile-errors"><strong>Please review the following:</strong><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
    <section class="profile-hero">
        <div class="profile-avatar">{{ $initials ?: 'SH' }}</div><div><h2>{{ $user->full_name ?: 'ScholarHunt Student' }}</h2><p>{{ $user->email }}</p><span class="verified">{{ $user->email_verified_at ? '✓ Email verified' : 'ScholarHunt student account' }}</span></div>
    </section>
    <div class="profile-layout">
        <section class="profile-card">
            <header class="profile-card-head"><h2>Personal and student information</h2><p>Update your contact details, education, and address.</p></header>
            <div class="profile-card-body">
                <form method="POST" action="{{ route('dashboard.profile.update') }}">
                    @csrf @method('PUT')
                    <div class="profile-form-grid">
                        <div class="profile-section-label">PERSONAL INFORMATION</div>
                        <div class="profile-field"><label for="first_name">First name *</label><input id="first_name" name="first_name" value="{{ old('first_name',$user->first_name) }}" maxlength="80" required autocomplete="given-name"></div>
                        <div class="profile-field"><label for="middle_name">Middle name</label><input id="middle_name" name="middle_name" value="{{ old('middle_name',$user->middle_name) }}" maxlength="80" autocomplete="additional-name"></div>
                        <div class="profile-field"><label for="surname">Surname *</label><input id="surname" name="surname" value="{{ old('surname',$user->surname) }}" maxlength="80" required autocomplete="family-name"></div>
                        <div class="profile-field"><label for="birthday">Birthday *</label><input id="birthday" type="date" name="birthday" max="{{ now()->subDay()->toDateString() }}" value="{{ old('birthday',$user->birthday?->format('Y-m-d')) }}" required></div>
                        <div class="profile-field"><label for="sex">Sex *</label><select id="sex" name="sex" required><option value="">Select</option><option value="male" @selected(old('sex',$user->sex)==='male')>Male</option><option value="female" @selected(old('sex',$user->sex)==='female')>Female</option></select></div>
                        <div class="profile-field"><label for="contact_number">Contact number *</label><input id="contact_number" name="contact_number" value="{{ old('contact_number',$user->contact_number) }}" maxlength="15" required autocomplete="tel"></div>
                        <div class="profile-section-label">EDUCATION</div>
                        <div class="profile-field"><label for="education_level">Current level *</label><select id="education_level" name="education_level" required><option value="shs" @selected(old('education_level',$user->education_level)==='shs')>Senior High School</option><option value="college" @selected(old('education_level',$user->education_level)==='college')>College</option></select></div>
                        <div class="profile-field" id="shs-grade-field"><label for="shs_grade">SHS grade level</label><select id="shs_grade" name="shs_grade"><option value="">Select grade</option><option value="11" @selected(old('shs_grade',$user->shs_grade)==='11')>Grade 11</option><option value="12" @selected(old('shs_grade',$user->shs_grade)==='12')>Grade 12</option></select></div>
                        <div class="profile-field" id="shs-strand-field"><label for="shs_strand">SHS strand</label><input id="shs_strand" name="shs_strand" value="{{ old('shs_strand',$user->shs_strand) }}" maxlength="20" placeholder="e.g. STEM, HUMSS"></div>
                        <div class="profile-field" id="college-year-field"><label for="college_year">College year</label><select id="college_year" name="college_year"><option value="">Select year</option>@foreach(['1'=>'1st year','2'=>'2nd year','3'=>'3rd year','4'=>'4th year','5'=>'5th year'] as $value=>$label)<option value="{{ $value }}" @selected(old('college_year',$user->college_year)===$value)>{{ $label }}</option>@endforeach</select></div>
                        <div class="profile-field" id="college-course-field"><label for="college_course">Course / program</label><input id="college_course" name="college_course" value="{{ old('college_course',$user->college_course) }}" maxlength="150" placeholder="e.g. BS Information Technology"></div>
                        <div class="profile-field"><label for="school_name">School name *</label><input id="school_name" name="school_name" value="{{ old('school_name',$user->school_name) }}" maxlength="150" required></div>
                        <div class="profile-field"><label for="school_address">School address *</label><input id="school_address" name="school_address" value="{{ old('school_address',$user->school_address) }}" maxlength="255" required></div>
                        <div class="profile-section-label">HOME ADDRESS</div>
                        <div class="profile-field full"><label for="address_street">House number / street *</label><input id="address_street" name="address_street" value="{{ old('address_street',$user->address_street) }}" maxlength="150" required autocomplete="street-address"></div>
                        <div class="profile-field"><label for="address_barangay">Barangay *</label><input id="address_barangay" name="address_barangay" value="{{ old('address_barangay',$user->address_barangay) }}" maxlength="100" required></div>
                        <div class="profile-field"><label for="address_city">City / municipality *</label><input id="address_city" name="address_city" value="{{ old('address_city',$user->address_city) }}" maxlength="100" required></div>
                        <div class="profile-field"><label for="address_province">Province *</label><input id="address_province" name="address_province" value="{{ old('address_province',$user->address_province) }}" maxlength="100" required></div>
                        <div class="profile-field"><label for="address_zip">ZIP code (4 digits) *</label><input id="address_zip" name="address_zip" inputmode="numeric" pattern="[0-9]{4}" maxlength="4" value="{{ old('address_zip',$user->address_zip) }}" required></div>
                        <div class="profile-section-label">ACCOUNT EMAIL</div>
                        <div class="profile-field full"><label for="email">Email address *</label><input id="email" type="email" name="email" value="{{ old('email',$user->email) }}" maxlength="255" autocomplete="email" required><span class="password-hint">Changing your email signs you in with the new address. Email verification may be required again.</span></div>
                    </div>
                    <p class="required-note">* Required field. Make sure your contact and school details are current.</p>
                    <div class="profile-submit"><button type="submit">Save profile changes</button></div>
                </form>
            </div>
        </section>
        <div style="display:grid;gap:18px">
            <section class="profile-card">
                <header class="profile-card-head"><h2>Change password</h2><p>Use your current password to confirm this change.</p></header>
                <div class="profile-card-body">
                    <form method="POST" action="{{ route('dashboard.profile.password') }}">
                        @csrf @method('PUT')
                        <div class="password-stack">
                            <div class="profile-field"><label for="current_password">Current password *</label><input id="current_password" type="password" name="current_password" autocomplete="current-password" required></div>
                            <div class="profile-field"><label for="password">New password *</label><input id="password" type="password" name="password" minlength="8" autocomplete="new-password" required><span class="password-hint">Use at least 8 characters. Avoid reusing a password from another account.</span></div>
                            <div class="profile-field"><label for="password_confirmation">Confirm new password *</label><input id="password_confirmation" type="password" name="password_confirmation" minlength="8" autocomplete="new-password" required></div>
                        </div>
                        <div class="profile-submit"><button type="submit">Update password</button></div>
                    </form>
                    <div class="security-note"><svg viewBox="0 0 24 24" aria-hidden="true"><rect x="5" y="10" width="14" height="11" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3"/></svg><span>Your password is securely hashed before storage. Never share it with anyone, including people claiming to provide scholarship assistance.</span></div>
                </div>
            </section>
            <section class="profile-card"><header class="profile-card-head"><h2>Account details</h2><p>Information used to access your ScholarHunt account.</p></header><div class="profile-card-body"><div class="profile-field"><label>Email verification</label><input value="{{ $user->email_verified_at ? 'Verified' : 'Not verified' }}" readonly aria-readonly="true"><span class="password-hint">If you change your email address, verify it again when prompted.</span></div><div class="profile-field" style="margin-top:15px"><label>Member since</label><input value="{{ $user->created_at?->format('F d, Y') ?? '—' }}" readonly aria-readonly="true"></div></div></section>
        </div>
    </div>
</div>
@push('scripts')
<script>
(() => {
 const level=document.getElementById('education_level');
 if(!level)return;
 const sync=()=>{
  const shs=level.value==='shs';
  ['shs-grade-field','shs-strand-field'].forEach(id=>document.getElementById(id).hidden=!shs);
  ['college-year-field','college-course-field'].forEach(id=>document.getElementById(id).hidden=shs);
 };
 level.addEventListener('change',sync);sync();
})();
</script>
@endpush
@endsection
