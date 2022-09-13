<x-public-layout>
    <div class="md:grid md:grid-cols-2 justify-between gap-8 mt-12">
        <div class="bg-darker-3 border-t-8 border-b-8 border-t-piss-yellow border-b-piss-yellow flex items-center md:justify-end py-12" 
        style="background-image:url({{ url('resources/images/real-estate-bg.svg') }}); background-repeat: no-repeat;">
            <div class="Left-Space text-secondary text-5xl leading-tight pl-4 md:pr-14 md:text-right">
                What is <br>
                <span class="text-piss-yellow font-GraphikMedium">
                    the mission <br>
                    and vision <br>
                </span>
                of Dwelly
            </div>
        </div>
        <div class="flex items-center p-4 md:p-8 Right-Space xl:w-2/3">
            <div>
                <h1 class="text-5xl text-darker-3 font-GraphikSemibold">
                    Our <br>
                    Vision
                </h1>
                <p class="text-justify text-darker-3 text-lg font-GraphikLight pt-6">
                    Dwelly is an end to end property management firm started
                    with a mission to enable owners to manage and rent out
                    properties in a hassle free way. Dwelly aims to become a
                    virtual property manager for every real estate asset owner.
                </p>
            </div>
        </div>
    </div>
    <div class="Left-Space pt-20 pb-24 md:flex items-center">
        <h2 class="font-GraphikSemibold text-5xl text-darker-3 p-4 md:mr-36">
            Team <br>
            Dwelly
        </h2>
        <div class="bg-secondary border-l-8 border-l-piss-yellow">
            <div class="Right-Space">
                <div class="p-4 lg:w-3/4">
                    <h3 id="p-name" class="font-GraphikSemibold text-darker-3 text-2xl"></h3>
                    <p id="p-title" class="font-GraphikLight text-darker-3 text-lg"></p>
                    <a id="p-link" href="#" class="flex"><svg class="w-6 h-6 mr-1" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="96px" height="96px"><path fill="#0078d4" d="M24,4C12.954,4,4,12.954,4,24s8.954,20,20,20s20-8.954,20-20S35.046,4,24,4z"/><path d="M30,35v-9c0-1.103-0.897-2-2-2s-2,0.897-2,2v9h-6V18h6v1.027C27.04,18.359,28.252,18,29.5,18	c3.584,0,6.5,2.916,6.5,6.5V35H30z M13,35V18h2.966C14.247,18,13,16.738,13,14.999C13,13.261,14.267,12,16.011,12	c1.696,0,2.953,1.252,2.989,2.979C19,16.733,17.733,18,15.988,18H19v17H13z" opacity=".05"/><path d="M30.5,34.5V26c0-1.378-1.121-2.5-2.5-2.5s-2.5,1.122-2.5,2.5v8.5h-5v-16h5v1.534	c1.09-0.977,2.512-1.534,4-1.534c3.309,0,6,2.691,6,6v10H30.5z M13.5,34.5v-16h5v16H13.5z M15.966,17.5	c-1.429,0-2.466-1.052-2.466-2.501c0-1.448,1.056-2.499,2.511-2.499c1.436,0,2.459,1.023,2.489,2.489	c0,1.459-1.057,2.511-2.512,2.511H15.966z" opacity=".07"/><path fill="#fff" d="M14,19h4v15h-4V19z M15.988,17h-0.022C14.772,17,14,16.11,14,14.999C14,13.864,14.796,13,16.011,13	c1.217,0,1.966,0.864,1.989,1.999C18,16.11,17.228,17,15.988,17z M35,24.5c0-3.038-2.462-5.5-5.5-5.5	c-1.862,0-3.505,0.928-4.5,2.344V19h-4v15h4v-8c0-1.657,1.343-3,3-3s3,1.343,3,3v8h4C35,34,35,24.921,35,24.5z"/></svg><span></span></a>
                    <p id="p-desc" class="my-6"></p>
                </div>
                <div class="flex pl-4">
                    <div id="p1" onclick="changeProfile('p1')" class="rounded-sm border-b-8 p-2 mx-2 cursor-pointer">
                        <img src="{{ url('resources/images/atif.png') }}" alt="Atif" class="h-16 grayscale hover:sepia ease-in-out duration-300">
                    </div>
                    <div id="p2" onclick="changeProfile('p2')" class="rounded-sm border-b-8 p-2 mx-2 cursor-pointer">
                        <img src="{{ url('resources/images/kaushal.png') }}" alt="Kaushal" class="h-16 grayscale hover:sepia ease-in-out duration-300">
                    </div>
                    <div id="p3" onclick="changeProfile('p3')" class="rounded-sm border-b-8 p-2 mx-2 cursor-pointer">
                        <img src="{{ url('resources/images/antarikh.png') }}" alt="Antarikh" class="h-16 grayscale hover:sepia ease-in-out duration-300">
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('before-body-end')
        <script>
            // Define Profiles Object
            const profiles = {
                p1: {
                    name: 'Atif Ayub',
                    title: 'Founding Member',
                    link: 'https://www.linkedin.com/',
                    desc: 'Atif is a Sales professional. He has worked with unicorn start-ups of India like OYO and Zomato. He is an IIT Guwahati graduate with 4 years of work experience.'
                },
                p2: {
                    name: 'Kaushal Choudhury',
                    title: 'Founder',
                    link: 'https://www.linkedin.com/in/kaushal-choudhury/',
                    desc: 'Kaushal is the founder of Dwelly. He is an operations professional and was previously working as the North East India Operations Head for OYO Rooms. He is a 2012 engineering graduate has worked with companies like FLSmidth.'
                },
                p3: {
                    name: 'Antarikh Baruah',
                    title: 'Founding Member, Operations ',
                    link: 'https://www.linkedin.com/',
                    desc: 'Antarikh is a sales and operations professional with 6 years of experience. He has previously worked with MNCs like American Express and EXL. He has also dabbled in the startup space of Bangalore before joining Dwelly.'
                }
            }


            // Define Profile Change Function
            function changeProfile(id) {
                document.getElementById('p-name').innerHTML = profiles[id].name;
                document.getElementById('p-title').innerHTML = profiles[id].title;
                document.getElementById('p-link').href = profiles[id].link;
                document.getElementById('p-link').children[1].innerHTML = profiles[id].name;
                document.getElementById('p-desc').innerHTML = profiles[id].desc;

                // Add class border-b-piss-yellow to current profile
                document.getElementById(id).classList.add('border-b-piss-yellow', 'bg-darker');
                // Remove classes grayscale and hover:sepia from current profile img
                document.getElementById(id).children[0].classList.remove('grayscale', 'hover:sepia');

                // Get all profiles except current profile
                const otherProfiles = Object.keys(profiles).filter((profile) => profile != id);

                // Remove class border-b-piss-yellow from other profiles and add grayscale to other profile img
                otherProfiles.forEach((profile) => {
                    document.getElementById(profile).classList.remove('border-b-piss-yellow', 'bg-darker');
                    document.getElementById(profile).children[0].classList.add('grayscale', 'hover:sepia');
                });
            }
            // default profile
            const defaultProfile = 'p2';

            // Load Default Profile
            changeProfile(defaultProfile);
        </script>
    @endsection
</x-public-layout>
