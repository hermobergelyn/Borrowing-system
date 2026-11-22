<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>School Sports Equipment Borrowing Logbook System</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['"Plus Jakarta Sans"', 'sans-serif'],
          }
        }
      }
    }
  </script>
</head>
<body class="min-h-screen flex flex-col bg-white text-slate-800 antialiased selection:bg-purple-200 selection:text-purple-950">

  <!-- Top Hero Wrapper (Soft Light Purple Gradient) -->
  <div class="relative bg-gradient-to-br from-purple-700 via-violet-600 to-purple-500 text-white pt-4 pb-24 px-4 sm:px-6">
    
    <!-- Floating White Pill Navbar -->
    <header class="sticky top-4 z-40 max-w-6xl mx-auto bg-white rounded-2xl px-6 py-3 flex items-center justify-between shadow-lg shadow-purple-950/15">
      <a href="{{ url('/') }}" class="flex items-center gap-2.5 text-purple-900 font-extrabold text-base tracking-tight">
        <span class="w-9 h-9 rounded-xl bg-gradient-to-br from-purple-500 to-violet-600 text-white flex items-center justify-center text-sm font-extrabold">
          SE
        </span>
        <span>SportsLog</span>
      </a>

      <nav class="flex items-center gap-7">
        <div class="hidden md:flex items-center gap-7">
          <a href="{{ url('/') }}" class="text-sm font-bold text-purple-700 border-b-2 border-purple-600 pb-0.5">
            Home
          </a>
          <a href="#gear" class="text-sm font-medium text-slate-600 hover:text-purple-700 transition">
            Sports Gear
          </a>
          <a href="#about" class="text-sm font-medium text-slate-600 hover:text-purple-700 transition">
            About Us
          </a>
          <a href="#contact" class="text-sm font-medium text-slate-600 hover:text-purple-700 transition">
            Contact Us
          </a>
        </div>

        <div class="flex items-center gap-2.5">
          <a href="{{ route('login') }}" class="px-5 py-2 rounded-lg bg-purple-100 hover:bg-purple-200 text-purple-800 text-sm font-bold transition">
            Log In
          </a>
          <a href="{{ route('register') }}" class="px-5 py-2 rounded-lg bg-purple-600 hover:bg-purple-700 text-white text-sm font-bold shadow-sm transition">
            Register
          </a>
        </div>
      </nav>
    </header>

    <!-- Centered Hero Content -->
    <div class="max-w-3xl mx-auto text-center pt-16 pb-6 px-2">
      <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/15 backdrop-blur-sm border border-white/25 text-white text-xs font-semibold mb-6">
        <span class="w-2 h-2 rounded-full bg-purple-200"></span>
        <span>School Sports Equipment Logbook</span>
      </div>

      <h1 class="text-3xl sm:text-5xl font-extrabold leading-tight tracking-tight text-white mb-5">
        Sports equipment borrowing, made simple
      </h1>

      <p class="text-base sm:text-lg leading-relaxed text-purple-100 max-w-2xl mx-auto mb-8 font-normal">
        SportsLog connects students and coaches with the PE inventory and gives staff an easier way to track, approve, and manage borrowed gear.
      </p>

      <div class="flex flex-wrap items-center justify-center gap-3">
        <a href="{{ route('login') }}" class="px-7 py-3 rounded-xl bg-white hover:bg-purple-50 text-purple-800 text-sm font-bold shadow-md transition hover:-translate-y-0.5">
          Borrow Equipment
        </a>
        <a href="#gear" class="px-7 py-3 rounded-xl bg-purple-900/35 hover:bg-purple-900/50 text-white border border-white/25 text-sm font-semibold transition">
          View Available Gear
        </a>
      </div>
    </div>
  </div>

  <!-- Main White Content Area -->
  <main class="flex-1 bg-white px-6 pt-16 pb-32 space-y-24">
    
    <!-- Section 1: Available Inventory -->
    <section class="max-w-5xl mx-auto" id="gear">
      <div class="text-center mb-12">
        <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-purple-100 text-purple-700 text-xs font-bold mb-3">
          Available Inventory
        </span>
        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
          Built for smooth PE & campus sports
        </h2>
        <p class="text-sm sm:text-base text-slate-500 mt-2 max-w-xl mx-auto">
          Check real-time stock before heading to the sports office.
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Item 1 -->
        <div class="rounded-2xl bg-purple-50/60 border border-purple-100 p-6 hover:shadow-lg hover:shadow-purple-900/5 transition">
          <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center font-extrabold text-sm">
              BB
            </div>
            <span class="px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200/60 text-xs font-bold">
              12 available
            </span>
          </div>
          <h3 class="text-base font-bold text-slate-900 mb-1">Spalding Basketballs</h3>
          <p class="text-xs text-slate-500 leading-relaxed">
            Indoor & outdoor standard balls ready for PE classes and varsity practice.
          </p>
        </div>

        <!-- Item 2 -->
        <div class="rounded-2xl bg-purple-50/60 border border-purple-100 p-6 hover:shadow-lg hover:shadow-purple-900/5 transition">
          <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-violet-100 text-violet-700 flex items-center justify-center font-extrabold text-sm">
              VB
            </div>
            <span class="px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200/60 text-xs font-bold">
              8 available
            </span>
          </div>
          <h3 class="text-base font-bold text-slate-900 mb-1">Mikasa Volleyballs</h3>
          <p class="text-xs text-slate-500 leading-relaxed">
            Official game-weight volleyballs stored in the gymnasium equipment room.
          </p>
        </div>

        <!-- Item 3 -->
        <div class="rounded-2xl bg-purple-50/60 border border-purple-100 p-6 hover:shadow-lg hover:shadow-purple-900/5 transition">
          <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-fuchsia-100 text-fuchsia-700 flex items-center justify-center font-extrabold text-sm">
              BD
            </div>
            <span class="px-3 py-1 rounded-full bg-amber-50 text-amber-700 border border-amber-200/60 text-xs font-bold">
              3 remaining
            </span>
          </div>
          <h3 class="text-base font-bold text-slate-900 mb-1">Badminton Rackets & Net</h3>
          <p class="text-xs text-slate-500 leading-relaxed">
            Pair of lightweight rackets with shuttlecock tube and portable net set.
          </p>
        </div>
      </div>
    </section>

    <!-- Section 2: About Us & Contact Us -->
    <section class="max-w-5xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch" id="about">
      
      <!-- About Us Card (7 columns) -->
      <div class="lg:col-span-7 rounded-3xl bg-purple-50/70 border border-purple-100 p-8 sm:p-10 flex flex-col justify-between">
        <div>
          <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-purple-100 text-purple-700 text-xs font-bold mb-4">
            About Us
          </span>
          <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight mb-4">
            Modernizing how our school tracks sports gear
          </h2>
          <p class="text-sm sm:text-base text-slate-600 leading-relaxed mb-4">
            The <strong class="text-purple-900">School Sports Equipment Borrowing Logbook System</strong> was created to replace slow, handwritten logbooks with a fast, accurate, and organized digital platform.
          </p>
          <p class="text-sm text-slate-600 leading-relaxed">
            Whether it's for daily Physical Education classes, varsity training, or campus intramurals, students and faculty can easily check equipment availability, submit borrowing requests, and ensure timely returns.
          </p>
        </div>

        <div class="grid grid-cols-3 gap-4 pt-6 mt-6 border-t border-purple-200/60">
          <div>
            <span class="block text-xl font-extrabold text-purple-700">100%</span>
            <span class="text-xs text-slate-500 font-medium">Digital Tracking</span>
          </div>
          <div>
            <span class="block text-xl font-extrabold text-purple-700">Fast</span>
            <span class="text-xs text-slate-500 font-medium">Request Approval</span>
          </div>
          <div>
            <span class="block text-xl font-extrabold text-purple-700">Zero</span>
            <span class="text-xs text-slate-500 font-medium">Lost Records</span>
          </div>
        </div>
      </div>

      <!-- Contact Us Card (5 columns) -->
      <div class="lg:col-span-5 rounded-3xl bg-white border border-purple-100 shadow-xl shadow-purple-900/5 p-8 sm:p-9 flex flex-col justify-between" id="contact">
        <div>
          <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-purple-100 text-purple-700 text-xs font-bold mb-4">
            Contact Us
          </span>
          <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 mb-2">
            Need help or have questions?
          </h3>
          <p class="text-sm text-slate-500 mb-6">
            Reach out directly through any of my official accounts below:
          </p>

          <div class="space-y-3.5">
            <!-- Facebook -->
            <a href="https://www.facebook.com/bergelyn.hermo" target="_blank" rel="noopener noreferrer" class="flex items-center gap-3.5 p-3.5 rounded-2xl bg-purple-50/70 hover:bg-purple-100/80 border border-purple-100 transition group">
              <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95z"/></svg>
              </div>
              <div class="min-w-0 flex-1">
                <span class="block text-xs font-semibold text-slate-400">Facebook</span>
                <span class="block text-sm font-bold text-slate-900 group-hover:text-purple-700 truncate">Bergelyn A. Hermo</span>
              </div>
              <span class="text-purple-400 group-hover:translate-x-0.5 transition">›</span>
            </a>

            <!-- Instagram -->
            <a href="https://www.instagram.com/bergelynhermo" target="_blank" rel="noopener noreferrer" class="flex items-center gap-3.5 p-3.5 rounded-2xl bg-purple-50/70 hover:bg-purple-100/80 border border-purple-100 transition group">
              <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-amber-500 via-pink-500 to-purple-600 text-white flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4H7.6m9.65 1.5a1.25 1.25 0 0 1 1.25 1.25A1.25 1.25 0 0 1 17.25 8 1.25 1.25 0 0 1 16 6.75a1.25 1.25 0 0 1 1.25-1.25M12 7a5 5 0 0 1 5 5 5 5 0 0 1-5 5 5 5 0 0 1-5-5 5 5 0 0 1 5-5m0 2a3 3 0 0 0-3 3 3 3 0 0 0 3 3 3 3 0 0 0 3-3 3 3 0 0 0-3-3z"/></svg>
              </div>
              <div class="min-w-0 flex-1">
                <span class="block text-xs font-semibold text-slate-400">Instagram</span>
                <span class="block text-sm font-bold text-slate-900 group-hover:text-purple-700 truncate">@bergelynhermo</span>
              </div>
              <span class="text-purple-400 group-hover:translate-x-0.5 transition">›</span>
            </a>

            <!-- Gmail -->
            <a href="mailto:hermobergelyn0@gmail.com" class="flex items-center gap-3.5 p-3.5 rounded-2xl bg-purple-50/70 hover:bg-purple-100/80 border border-purple-100 transition group">
              <div class="w-10 h-10 rounded-xl bg-rose-500 text-white flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4-8 5-8-5V6l8 5 8-5v2z"/></svg>
              </div>
              <div class="min-w-0 flex-1">
                <span class="block text-xs font-semibold text-slate-400">Gmail</span>
                <span class="block text-sm font-bold text-slate-900 group-hover:text-purple-700 truncate">hermobergelyn0@gmail.com</span>
              </div>
              <span class="text-purple-400 group-hover:translate-x-0.5 transition">›</span>
            </a>
          </div>
        </div>
      </div>

    </section>

  </main>

  <!-- Bottom CTA Banner & Light Purple Footer -->
  <footer class="relative bg-purple-50 px-6 pt-12 pb-8 border-t border-purple-100">
    
    <!-- Floating CTA Banner -->
    <div class="relative z-20 max-w-5xl mx-auto -mt-24 mb-12 bg-gradient-to-r from-purple-600 to-violet-600 rounded-2xl p-7 sm:px-9 flex flex-col md:flex-row items-start md:items-center justify-between gap-6 shadow-xl shadow-purple-900/15">
      <div>
        <h3 class="text-xl sm:text-2xl font-extrabold text-white mb-1">
          Borrow sports gear. Return on time.
        </h3>
        <p class="text-sm text-purple-100">
          Digital logbook system built for students, coaches, and PE instructors.
        </p>
      </div>
      <div class="flex items-center gap-3 shrink-0">
        <a href="{{ route('login') }}" class="px-5 py-2.5 rounded-xl bg-white hover:bg-purple-50 text-purple-800 text-sm font-bold transition shadow-sm">
          Log In
        </a>
        <a href="{{ route('register') }}" class="px-5 py-2.5 rounded-xl bg-purple-900/35 hover:bg-purple-900/50 text-white border border-white/25 text-sm font-bold transition">
          Create Account
        </a>
      </div>
    </div>

    <!-- Footer Links Grid -->
    <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-12 gap-10 pb-8 border-b border-purple-200/70">
      <div class="md:col-span-5">
        <a href="{{ url('/') }}" class="flex items-center gap-2.5 text-purple-950 font-extrabold text-base tracking-tight">
          <span class="w-9 h-9 rounded-xl bg-gradient-to-br from-purple-500 to-violet-600 text-white flex items-center justify-center text-sm font-extrabold">
            SE
          </span>
          <span>School Sports Equipment Borrowing Logbook</span>
        </a>
        <p class="mt-3 text-sm leading-relaxed text-slate-600 max-w-sm">
          A web-based logbook platform that helps students and school staff easily track, borrow, and manage sports equipment.
        </p>
      </div>

      <div class="md:col-span-3">
        <h5 class="text-xs font-bold uppercase tracking-wider text-purple-900/60 mb-3.5">Navigation</h5>
        <ul class="space-y-2.5 text-sm text-slate-600">
          <li><a href="{{ url('/') }}" class="hover:text-purple-700 hover:underline">Home</a></li>
          <li><a href="#gear" class="hover:text-purple-700 hover:underline">Sports Gear</a></li>
          <li><a href="#about" class="hover:text-purple-700 hover:underline">About Us</a></li>
          <li><a href="#contact" class="hover:text-purple-700 hover:underline">Contact Us</a></li>
        </ul>
      </div>

      <div class="md:col-span-4">
        <h5 class="text-xs font-bold uppercase tracking-wider text-purple-900/60 mb-3.5">Connect With Us</h5>
        <ul class="space-y-2.5 text-sm text-slate-600">
          <li>
            <a href="https://www.facebook.com/bergelyn.hermo" target="_blank" rel="noopener noreferrer" class="hover:text-purple-700 hover:underline">
              Facebook: Bergelyn A. Hermo
            </a>
          </li>
          <li>
            <a href="https://www.instagram.com/bergelynhermo" target="_blank" rel="noopener noreferrer" class="hover:text-purple-700 hover:underline">
              Instagram: @bergelynhermo
            </a>
          </li>
          <li>
            <a href="mailto:hermobergelyn0@gmail.com" class="hover:text-purple-700 hover:underline">
              Gmail: hermobergelyn0@gmail.com
            </a>
          </li>
        </ul>
      </div>
    </div>

    <!-- Bottom Copyright & Legal Links -->
    <div class="max-w-5xl mx-auto pt-5 flex flex-col sm:flex-row justify-between items-center gap-3 text-xs text-slate-500">
      <span>© 2026 School Sports Equipment Borrowing Logbook System. All rights reserved.</span>
      <div class="flex items-center gap-5">
        <button type="button" onclick="openModal('privacyModal')" class="hover:text-purple-700 hover:underline font-medium">Privacy Policy</button>
        <button type="button" onclick="openModal('termsModal')" class="hover:text-purple-700 hover:underline font-medium">Terms & Conditions</button>
      </div>
    </div>
  </footer>

  <!-- Privacy Policy Modal -->
  <div id="privacyModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/40 backdrop-blur-sm p-4">
    <div class="bg-white rounded-2xl max-w-lg w-full p-6 sm:p-7 shadow-2xl border border-purple-100">
      <div class="flex items-center justify-between border-b border-purple-100 pb-3 mb-4">
        <h3 class="text-lg font-extrabold text-purple-950">Privacy Policy</h3>
        <button type="button" onclick="closeModal('privacyModal')" class="text-slate-400 hover:text-purple-700 font-bold text-xl leading-none">×</button>
      </div>
      <div class="space-y-3 text-sm text-slate-600 leading-relaxed max-h-80 overflow-y-auto pr-1">
        <p><strong class="text-slate-800">1. Information We Collect:</strong> We collect your name, email, gender, phone number, student/employee ID, course and section or department, and borrowing history for school sports inventory tracking.</p>
        <p><strong class="text-slate-800">2. How We Use Information:</strong> Your details are used to verify equipment requests, record borrow/return timestamps, and notify you of overdue items.</p>
        <p><strong class="text-slate-800">3. Data Protection:</strong> All logbook records are kept confidential within the School Sports Office and PE Department and are never shared outside the institution.</p>
      </div>
      <div class="mt-6 flex justify-end">
        <button type="button" onclick="closeModal('privacyModal')" class="px-5 py-2 rounded-xl bg-purple-600 hover:bg-purple-700 text-white text-sm font-bold transition">
          I Understand
        </button>
      </div>
    </div>
  </div>

  <!-- Terms & Conditions Modal -->
  <div id="termsModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/40 backdrop-blur-sm p-4">
    <div class="bg-white rounded-2xl max-w-lg w-full p-6 sm:p-7 shadow-2xl border border-purple-100">
      <div class="flex items-center justify-between border-b border-purple-100 pb-3 mb-4">
        <h3 class="text-lg font-extrabold text-purple-950">Terms & Conditions</h3>
        <button type="button" onclick="closeModal('termsModal')" class="text-slate-400 hover:text-purple-700 font-bold text-xl leading-none">×</button>
      </div>
      <div class="space-y-3 text-sm text-slate-600 leading-relaxed max-h-80 overflow-y-auto pr-1">
        <p><strong class="text-slate-800">1. Eligibility:</strong> Only enrolled students, faculty members, and authorized coaches with a valid school account may borrow sports equipment.</p>
        <p><strong class="text-slate-800">2. Care & Responsibility:</strong> Borrowers are responsible for inspecting items upon pickup and returning them in good condition within the scheduled PE period or intramural session.</p>
        <p><strong class="text-slate-800">3. Lost or Damaged Gear:</strong> Any intentional damage or unreturned equipment must be reported immediately to the PE Department and may be subject to replacement rules.</p>
      </div>
      <div class="mt-6 flex justify-end">
        <button type="button" onclick="closeModal('termsModal')" class="px-5 py-2 rounded-xl bg-purple-600 hover:bg-purple-700 text-white text-sm font-bold transition">
          Agree & Close
        </button>
      </div>
    </div>
  </div>

  <script>
    function openModal(id) {
      const modal = document.getElementById(id);
      modal.classList.remove('hidden');
      modal.classList.add('flex');
    }

    function closeModal(id) {
      const modal = document.getElementById(id);
      modal.classList.add('hidden');
      modal.classList.remove('flex');
    }
  </script>

</body>
</html>