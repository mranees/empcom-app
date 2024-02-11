<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Create New Employee') }}
      </h2>
  </x-slot>
  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900">
                  <div class="flex flex-col">
                      <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                          <div class="overflow-hidden">
                              <form name="create-company" id="create-company" method="POST" action="{{ route('employee.update', $employee->id) }}" enctype="multipart/form-data">
                                  @csrf
                                  @method('PUT')
                                  <div class="space-y-12">
                                      <div class="border-b border-gray-900/10 pb-12">
                                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                          <div class="col-span-full">
                                            <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Employee Name</label>
                                            <div class="mt-2">
                                              <input type="text" name="name" value="{{ $employee->name }}" id="first-name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                  @error('name')
                                                      <span class="text-red-700 text-sm" role="alert">
                                                          <strong>{{ $message }}</strong>
                                                      </span>
                                                  @enderror
                                            </div>
                                          </div>
                                  
                                          <div class="col-span-full">
                                            <label for="street-address" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                                            <div class="mt-2">
                                              <input type="password" name="password" id="street-address" autocomplete="street-address" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                              <span class="text-sm" role="alert">
                                                <strong>leave it blank if you don't want to change it.</strong>
                                            </span>
                                              @error('password')
                                                  <span class="text-red-700 text-sm" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                  </span>
                                              @enderror
                                            </div>
                                          </div>
                                  
                                          <div class="col-span-full">
                                            <label for="street-address" class="block text-sm font-medium leading-6 text-gray-900">Employee eMail address</label>
                                            <div class="mt-2">
                                              <input type="email" name="email" value="{{ $employee->email }}" id="street-address" autocomplete="street-address" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                              @error('email')
                                                  <span class="text-red-700 text-sm" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                  </span>
                                              @enderror
                                            </div>
                                          </div>
                                  
                                          <div class="col-span-full">
                                            <label for="street-address" class="block text-sm font-medium leading-6 text-gray-900">Employee Company</label>
                                            <div class="mt-2">
                                              <select name="company" id="company" class="rounded" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                  <option value="{{ $employee->company }}">{{ $employee->company }}</option>
                                                  @foreach ($companies as $company)
                                                  <option value="{{ $company->name }}">{{ $company->name }}</option>
                                                  @endforeach
                                              </select>
                                              @error('company')
                                                  <span class="text-red-700 text-sm" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                  </span>
                                              @enderror
                                            </div>
                                          </div>

                                        </div>
                                      </div>
                                    <div class="border-b border-gray-900/10 pb-12">
                                      <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                        
                                        <div class="col-span-full">
                                          <label for="cover-photo" class="block text-sm font-medium leading-6 text-gray-900">Company Logo</label>
                                          <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                                            <div class="text-center">
                                              <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                                              </svg>
                                              <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                                <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                                  <span>Upload a file</span>
                                                  <input id="file-upload" name="image" type="file" class="sr-only">
                                                </label>
                                                <p class="pl-1">or drag and drop</p>
                                              </div>
                                              <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                                              @error('image')
                                                  <span class="text-red-700 text-sm" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                  </span>
                                              @enderror
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                
                                  <div class="mt-6 flex items-center justify-end gap-x-6">
                                    <a href="/company" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
                                    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                                  </div>
                                </form>            
                          </div>
                        </div>
                      </div>
                    </div>
                  
              </div>
          </div>
      </div>
  </div>
</x-app-layout>