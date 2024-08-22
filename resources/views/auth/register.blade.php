<x-guest-layout>
<form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- Name -->
    <div>
        <label for="name">Name</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}" required>
        @error('name')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <!-- Email -->
    <div>
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required>
        @error('email')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <!-- Address -->
    <div>
        <label for="address">Address</label>
        <input id="address" type="text" name="address" value="{{ old('address') }}" required>
        @error('address')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <!-- Contact No -->
    <div>
        <label for="contact_no">Contact No</label>
        <input id="contact_no" type="text" name="contact_no" value="{{ old('contact_no') }}" required>
        @error('contact_no')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <!-- Date of Birth -->
    <div>
        <label for="dob">Date of Birth</label>
        <input id="dob" type="date" name="dob" value="{{ old('dob') }}" required>
        @error('dob')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <!-- Password -->
    <div>
        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>
        @error('password')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <!-- Confirm Password -->
    <div>
        <label for="password_confirmation">Confirm Password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required>
    </div>

    <div>
        <button type="submit">Register</button>
    </div>
</form>

</x-guest-layout>
