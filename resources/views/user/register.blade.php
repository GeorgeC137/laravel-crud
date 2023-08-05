<x-app-layout>
    <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
          <h2
            class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900"
          >
            Sign Up 
          </h2>
        </div>
    
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
          <form class="space-y-6" action="{{route('register.user')}}" method="post">
            @csrf
            <div>
              <label for="full_name" class="block text-sm font-medium @error('full_name')border-red-500 @enderror leading-6 text-gray-900"
                >Full Name</label
              >
              <div class="mt-2">
                <input value="{{old('full_name')}}"
                  id="full_name"
                  name="full_name"
                  type="text"
                  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6 @error('full_name')
                    border-red-500 
                  @enderror"
                />
                @error('full_name')
                    <p class="text-red-500 font-semibold">{{$message}}</p>
                @enderror
              </div>
            </div>

            <div>
              <label for="email" class="block text-sm font-medium leading-6 text-gray-900"
                >Email address</label
              >
              <div class="mt-2">
                <input value="{{old('email')}}"
                  id="email"
                  name="email"
                  type="email"
                  autocomplete="email"
                  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6"
                />
                @error('email')
                    <p class="text-red-500 font-semibold">{{$message}}</p>
                @enderror
              </div>
            </div>
    
            <div>
              <div class="flex items-center justify-between">
                <label
                  for="password"
                  class="block text-sm font-medium leading-6 text-gray-900"
                  >Password</label
                >
              </div>
              <div class="mt-2">
                <input
                  id="password"
                  name="password"
                  type="password"
                  autocomplete="current-password"
                  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6"
                />
                @error('password')
                    <p class="text-red-500 font-semibold">{{$message}}</p>
                @enderror
              </div>
            </div>

            <div class="flex items-center justify-between">
                <label
                  for="password_confirmation"
                  class="block text-sm font-medium leading-6 text-gray-900"
                  >Confirm Password</label
                >
              </div>
              <div class="mt-2">
                <input
                  id="password_confirmation"
                  name="password_confirmation"
                  type="password"
                  autocomplete="current-password"
                  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6"
                />
            </div>
    
            <div>
              <button
                type="submit"
                class="flex w-full justify-center rounded-md bg-green-500 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-green-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600"
              >
                Sign up
              </button>
            </div>
          </form>
    
          <p class="mt-10 text-center text-sm text-gray-500">
            Already have an account?
            {{ " " }}
            <a
              href="{{route('show.login')}}"
              class="font-semibold leading-6 text-green-500 hover:text-green-700"
              >Login</a
            >
          </p>
        </div>
      </div>
</x-app-layout>
