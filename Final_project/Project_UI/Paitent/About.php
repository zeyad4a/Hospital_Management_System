<?php

session_start();
$connect = new mysqli("localhost", "root", "", "hms");
if ($connect->connect_error) {
  die("Connection failed: " . $connect->connect_error);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About</title>
  <link rel="stylesheet" href="./about.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="icon" href="./photo/echol.png">
</head>

<body>

  <div class="bg-white">
    <div class="relative isolate px-6 pt-14 lg:px-8">
      <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
        <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
        </div>
      </div>
      <header class="absolute inset-x-0 top-0 z-50">
        <nav class=" bg-slate-800 flex items-center justify-between p-3 lg:px-8" aria-label="Global">
          <div class="flex lg:flex-1">
            <a href="#" class="-m-1.5 p-1.5">
              <span class="sr-only">Your Company</span>
              <img class="h-16 w-16" src="./photo/l-gh.png">
            </a>
          </div>
          <form action="./done-patint/index.php" method="post" class="hidden lg:flex lg:flex-1 lg:justify-end">
            <button name="login" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-lg font-bold">Log in →</button>
          </form>
        </nav>
      </header>
      <main class="">
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">

          <div class="relative isolate px-6 lg:px-8 -translate-y-12">
            <div class="mx-auto max-w-2xl  sm:py-48 lg:py-56">

              <div class="text-center">
                <img class=" relative left-56 mx-4 bottom-12 h-48 w-48" src="./photo/black echo.png">
                <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">ECHO Medical Group</h1>
                <p class="mt-6 text-lg font-bold leading-10 text-gray-600"> In Echo We Care About You "😊" </p>
                <form action="./done-patint/index.php" method="post" class="mt-10 flex items-center justify-center gap-x-6">
                  <button name="login1" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Get
                    started</button>
                </form>
              </div>
            </div>
          </div>


          <div class="h-72 w-full overflow-hidden rounded-lg relative bottom-20">
            <h1 class=" font-bold tracking-tight text-gray-900 sm:text-3xl relative top-32 left-5 ">About Us</h1>
            <div class=" aspect-h-1 aspect-w-1 overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-60 ">
              <img src="./photo/breadcrumb-image-1.jpg" class="h-full w-full object-cover object-center lg:h-full lg:w-full">
            </div>
          </div>

          <div class="relative overflow-hidden bg-white">
            <div class="pb-80 pt-16 sm:pb-40 sm:pt-24 lg:pb-48 lg:pt-40">
              <div class="relative mx-auto max-w-7xl px-4 sm:static sm:px-6 lg:px-8">
                <div class="sm:max-w-lg">
                  <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">About Us</h1>
                  <p class="mt-4 text-xl text-gray-500">Welcome to ECHO , where your health and well-being are our top priorities. Our team of experienced healthcare professionals and medical writers work tirelessly to ensure that the content we provide is accurate, easy to understand, and relevant to your needs </p>
                </div>
                <div>
                  <div class="mt-10">

                    <div aria-hidden="true" class="pointer-events-none lg:absolute lg:inset-y-0 lg:mx-auto lg:w-full lg:max-w-7xl">
                      <div class="absolute transform sm:left-1/2 sm:top-0 sm:translate-x-8 lg:left-1/2 lg:top-1/2 lg:-translate-y-1/2 lg:translate-x-8">
                        <div class="flex items-center space-x-6 lg:space-x-8">
                          <div class="grid flex-shrink-0 grid-cols-1 gap-y-6 lg:gap-y-8">
                            <div class="h-64 w-44 overflow-hidden rounded-lg sm:opacity-0 lg:opacity-100">
                              <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-48 ">
                                <img src="./photo/about-horizontal-img.jpg" class="h-full">
                              </div>
                            </div>
                            <div class="h-64 w-44 overflow-hidden rounded-lg">
                              <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-48 ">
                                <img src="./photo/docs.jpeg" class="h-full">
                              </div>
                            </div>
                          </div>
                          <div class="grid flex-shrink-0 grid-cols-1 gap-y-6 lg:gap-y-8">
                            <div class="h-64 w-44 overflow-hidden rounded-lg">
                              <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-48 ">
                                <img src="./photo/dental.jpg" class="h-full">
                              </div>
                            </div>
                            <div class="h-64 w-44 overflow-hidden rounded-lg">
                              <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-44 ">
                                <img src="./photo/dc.jpg" class="h-full">
                              </div>
                            </div>
                            <div class="h-64 w-44 overflow-hidden rounded-lg">
                              <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-48 ">
                                <img src="./photo/care2.jpeg" class="w-full h-full">
                              </div>
                            </div>
                          </div>
                          <div class="grid flex-shrink-0 grid-cols-1 gap-y-6 lg:gap-y-8">
                            <div class="h-64 w-44 overflow-hidden rounded-lg">
                              <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-48 ">
                                <img src="./photo/dov.jpeg" class="h-full">
                              </div>
                            </div>
                            <div class="h-64 w-44 overflow-hidden rounded-lg">
                              <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-48 ">
                                <img src="./photo/care.jpeg" class="h-full">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <a href="./done-patint/index.php" class="inline-block rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-center font-medium text-white hover:bg-indigo-700">Book
                      now</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="bg-white">
            <div class="mx-auto grid max-w-2xl grid-cols-1 items-center gap-x-8 gap-y-16 px-4 py-24 sm:px-6 sm:py-32 lg:max-w-7xl lg:grid-cols-2 lg:px-8">
              <div>


                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Explore Some Of Our Main Service</h2>
                <p class="mt-4 text-gray-500">If you are looking for information on specific conditions, tips for maintaining a healthy lifestyle, or the latest in medical research, you can trust us to be your go-to resource. At ECHO , we believe that everyone deserves access to high-quality healthcare information, and we are committed to empowering you on your journey to better health..</p>

                <dl class="mt-16 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 sm:gap-y-16 lg:gap-x-8">
                  <div class="border-t border-gray-200 pt-4">
                    <dt class="font-medium text-gray-900">
                      Cardiology</dt>
                    <dd class="mt-2 text-sm text-gray-500">Cardiology focuses on diagnosing and treating heart ailments like arrhythmias and congenital defects. It utilizes tools like ECGs to assess heart health and guide treatment plans.</dd>
                  </div>
                  <div class="border-t border-gray-200 pt-4">
                    <dt class="font-medium text-gray-900">Oncologist</dt>
                    <dd class="mt-2 text-sm text-gray-500">An oncologist is a medical doctor specializing in cancer care. They guide patients through diagnosis, treatment, and post-treatment care, working with a team to create personalized plans. In essence, oncologists are cancer specialists who oversee all aspects of a patient's care.</dd>
                  </div>
                  <div class="border-t border-gray-200 pt-4">
                    <dt class="font-medium text-gray-900">Plastic surgery</dt>
                    <dd class="mt-2 text-sm text-gray-500">Plastic surgery tackles both cosmetic and medical concerns. It uses a blend of artistry and medical knowledge to reconstruct, repair, or improve physical appearance and function..</dd>
                  </div>
                  <div class="border-t border-gray-200 pt-4">
                    <dt class="font-medium text-gray-900">
                      Eye Care</dt>
                    <dd class="mt-2 text-sm text-gray-500">Your trusted partner in eye care! We offer comprehensive resources & expert advice to keep your vision healthy.</dd>
                  </div>
                  <div class="border-t border-gray-200 pt-4">
                    <dt class="font-medium text-gray-900">Neurology</dt>
                    <dd class="mt-2 text-sm text-gray-500">Neurology is the medical field for nervous system disorders like epilepsy and migraines. Neurologists use expertise and research to improve patients' lives.</dd>
                  </div>
                  <div class="border-t border-gray-200 pt-4">
                    <dt class="font-medium text-gray-900">Pediatric specialist</dt>
                    <dd class="mt-2 text-sm text-gray-500">
                      Board-certified pediatricians at your practice offer compassionate care for infants, children, and adolescents. They address everything from routine check-ups to complex conditions, ensuring your child's optimal health in a supportive environment.</dd>
                  </div>
                </dl>
              </div>
              <div class="grid grid-cols-2 grid-rows-2 gap-4 sm:gap-6 lg:gap-8 ">
                <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-48 ">
                  <img src="./photo/heartph.jpg" class="w-full h-full">
                </div>
                <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-48 ">
                  <img src="./photo/awram.jpg" class="w-full h-full">
                </div>
                <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-48 ">
                  <img src="./photo/tagmel.jpg" class="w-full h-full">
                </div>
                <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-48 ">
                  <img src="./photo/Eyecare.jpg" class="w-full h-full">
                </div>
                <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-48 ">
                  <img src="./photo/brain.jpeg" class="w-full h-full">
                </div>
                <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-48 ">
                  <img src="./photo/baby.jpg" class="w-full h-full">
                </div>
              </div>
            </div>
          </div>


          <!-- <div class="bg-white">
            <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
              <h2 class="text-2xl font-bold tracking-tight text-gray-900">Our Client Happy Say About Us</h2>

              <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                <div class="group relative">
                  <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">

                  </div>
                </div>
                <div class="group relative">
                  <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">

                  </div>
                </div>
                <div class="group relative">
                  <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">

                  </div>
                </div>
                <div class="group relative">
                  <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">

                  </div>
                </div>
              </div>
            </div>
          </div> -->

          <div class="bg-white py-24 sm:py-32">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
              <h2 class="text-center text-lg font-semibold leading-8 text-gray-900">Trusted by the world’s most innovative teams
              </h2>
              <div class="mx-auto mt-10 grid max-w-lg grid-cols-4 items-center gap-x-8 gap-y-10 sm:max-w-xl sm:grid-cols-6 sm:gap-x-10 lg:mx-0 lg:max-w-none lg:grid-cols-5">
                <img class="col-span-2 max-h-12 w-full object-contain lg:col-span-1" src="./photo/1.png" width="164" height="48">
                <img class="col-span-2 max-h-12 w-full object-contain lg:col-span-1" src="./photo/2.png" width="164" height="48">
                <img class="col-span-2 max-h-12 w-full object-contain lg:col-span-1" src="./photo/3.png" width="164" height="48">
                <img class="col-span-2 max-h-12 w-full object-contain sm:col-start-2 lg:col-span-1" src="./photo/4.png" width="164" height="48">
                <img class="col-span-2 col-start-2 max-h-12 w-full object-contain sm:col-start-auto lg:col-span-1" src="./photo/5.png" width="164" height="48">
              </div>
            </div>
          </div>



        </div>
      </main>
</body>

</html>