const { useState } = React;

/* ---------- Mark: a square frame with one corner opened, one piece pushed through ---------- */
const Logo = ({ size = 40, ink = '#1F1B1A', accent = '#A83232' }) => (
  <svg width={size} height={size} viewBox="0 0 48 48" role="img"
       aria-label="Mark: a square frame with one corner opened and a small square pushed through it">
    <path d="M26 6H6v36h36V26" fill="none" stroke={ink} strokeWidth="4"
          strokeLinecap="square" strokeLinejoin="miter" />
    <rect x="34" y="2" width="11" height="11" fill={accent} />
  </svg>
);

/* ---------- Photo with fallback: crop to 4:5, export 1200 x 1500 px, save as assets/photo.jpg ---------- */
const Photo = () => {
  const [ok, setOk] = useState(true);
  return ok ? (
    <img src="assets/photo.jpg"
         alt="John Jairuh Ochoa, portrait"
         className="h-full w-full object-cover"
         onError={() => setOk(false)} />
  ) : (
    <div role="img" aria-label="Photo placeholder showing the initials JO"
         className="flex h-full w-full items-center justify-center bg-brick font-serif text-8xl text-white">
      JO
    </div>
  );
};

/* ---------- Content. Empty strings are skipped on render, so nothing gets invented. ---------- */
const PROJECTS = [
  {
    name: 'Julie Repol Beauty Salon',
    stack: 'PHP, MySQL, plain CSS',
    problem: 'A salon needed online reservations, and its staff needed one admin view of every booking.',
    tried: 'The admin dashboard kept returning an HTTP 500. The fault was the order I had put the authentication steps in, not the logic inside them.',
    shipped: 'A reservation flow for customers and an admin dashboard for staff. Queries use prepared statements, and anything printed back to a page goes through htmlspecialchars().',
    redoLabel: 'What I would change',
    redo: 'Write the access check before any page exists, and test with a wrong login before a right one. This is hygiene, not a security review. Nobody has tried to break it.',
    note: 'The source is not on my machine anymore. More on that below.'
  },
  {
    name: 'Enterprise network in Packet Tracer',
    stack: 'Cisco Packet Tracer',
    problem: 'Eight subnets and eighty PCs have to reach each other and a web server without anyone typing eighty addresses by hand.',
    tried: '', // add: what you tried that failed
    shipped: 'A topology with 8 subnets, 80 DHCP-assigned PCs, DNS, and a web server at www.ochoa.com. OSPF, RIPv2 and EIGRP run side by side with route redistribution between them.',
    redoLabel: 'What I would change',
    redo: '', // add: one thing you would do differently
    note: 'The file was lost with everything else.'
  },
  {
    name: 'Cellphone repair job order system',
    stack: 'Group thesis, four of us. In design, not built.',
    problem: 'Jake Cellphone Repair Shop in Karuhatan needs customers to submit repair requests and follow progress, and staff to manage job orders.',
    tried: '',
    shipped: 'Not shipped. So far: requirements, an ERD, use cases for the owner, staff and customers, and wireframes.',
    redoLabel: 'What I am watching',
    redo: 'Customers look up a repair with a reference number. If those numbers count up one at a time, anyone can read anyone else\'s repair status. How they get generated is a security question I want answered before anyone writes the page.',
    note: ''
  }
];

/* ---------- Small building blocks ---------- */
const Field = ({ label, children }) =>
  children ? (
    <div className="py-4 sm:grid sm:grid-cols-[9rem_1fr] sm:gap-6">
      <dt className="mb-1 text-sm font-semibold text-muted sm:mb-0">{label}</dt>
      <dd className="font-serif text-lg leading-relaxed">{children}</dd>
    </div>
  ) : null;

const Section = ({ label, children, tone = '' }) => (
  <section className={'px-6 py-16 md:grid md:grid-cols-[11rem_minmax(0,40rem)] md:gap-x-10 md:py-24 md:pl-[8vw] ' + tone}>
    <h2 className="mb-6 text-sm font-semibold text-muted md:mb-0 md:pt-2">{label}</h2>
    <div>{children}</div>
  </section>
);

const A = ({ href, children }) => (
  <a href={href}
     className="text-brick underline decoration-1 underline-offset-4 hover:text-brick-deep focus:outline-none focus-visible:ring-2 focus-visible:ring-brick focus-visible:ring-offset-2">
    {children}
  </a>
);

/* ---------- Sections ---------- */
const Top = () => (
  <header className="flex items-center gap-3 px-6 py-5 md:pl-[8vw]">
    <Logo size={40} />
    <span className="text-sm font-semibold">Jai Ochoa</span>
  </header>
);

const Opening = () => (
  <section className="md:flex md:items-end">
    {/* 4:5 portrait bleeding off the left edge; text sits level with its lower third */}
    <div className="aspect-[4/5] w-[82%] overflow-hidden md:w-[34vw] md:max-w-[34rem] md:shrink-0">
      <Photo />
    </div>
    <div className="px-6 pb-4 pt-8 md:pb-12 md:pl-14 md:pr-[8vw] md:pt-0">
      <h1 className="font-serif text-4xl font-semibold leading-[1.05] md:text-6xl">
        John Jairuh Ochoa
      </h1>
      <p className="mt-3 text-lg text-muted">Web developer. Learning security on purpose.</p>
      <p className="mt-8 max-w-[34rem] font-serif text-xl leading-relaxed">
        Writing software taught me that every program is a pile of assumptions about who will use it and how. I am learning security to find out which of mine are wrong.
      </p>
    </div>
  </section>
);

const Argument = () => (
  <Section label="The argument">
    <div className="space-y-5 font-serif text-lg leading-relaxed">
      <p>A program works until someone does something its author did not expect. That someone might be a tired customer, a typo, or a person trying to get in. From inside the code, you cannot always tell which.</p>
      <p>That is the overlap I care about. When I build, I decide what a system assumes. When I read about attacks, I read what happens when those assumptions are false on purpose. Same material, opposite direction.</p>
      <p>I am closer to the first than the second. The projects below show the habit. None of them prove I am good at breaking things yet.</p>
    </div>
  </Section>
);

const Work = () => (
  <Section label="Projects">
    <p className="mb-10 font-serif text-lg leading-relaxed">
      Three, and the third is not finished. I would rather show three honestly than pad it to five.
    </p>
    <div className="space-y-16">
      {PROJECTS.map((p, i) => (
        <article key={p.name} className={i % 2 ? 'md:ml-12' : ''}>
          <h3 className="font-serif text-2xl font-semibold">{p.name}</h3>
          <p className="mt-1 text-sm text-muted">{p.stack}</p>
          <dl className="mt-4 divide-y divide-line border-y border-line">
            <Field label="The problem">{p.problem}</Field>
            <Field label="What did not work">{p.tried}</Field>
            <Field label="What I shipped">{p.shipped}</Field>
            <Field label={p.redoLabel}>{p.redo}</Field>
          </dl>
          {p.note && <p className="mt-3 text-sm text-muted">{p.note}</p>}
        </article>
      ))}
    </div>
  </Section>
);

const Security = () => (
  <Section label="Security, in progress" tone="md:bg-white">
    <p className="mb-6 font-serif text-lg leading-relaxed">
      This section is short because the work is short. I would rather it read that way than get padded.
    </p>
    <dl className="divide-y divide-line border-y border-line">
      <Field label="Doing now">Cisco Networking Academy coursework. It is not finished, so it is not listed as a credential anywhere on this page.</Field>
      <Field label="Next">Small labs that I build and break myself, on my own machines. Each one gets written up here when it is done, including the parts that failed.</Field>
      <Field label="Not yet">Nothing tested against real systems. No security certifications. No bug reports.</Field>
    </dl>
  </Section>
);

const About = () => (
  <Section label="About">
    <div className="space-y-5 font-serif text-lg leading-relaxed">
      <p>I am a BSIT student at PLV. I build in PHP, MySQL and JavaScript, write some Java, and design networks in Packet Tracer. Security came second. Once I was writing software other people would use, I got curious about how it fails.</p>
      <p>My projects were all deleted recently, and I had no backup. I am not going to pretend that is a good look for someone who wants to work in security. It is also the clearest argument for off-site copies I have ever had. New work goes to GitHub from the first day.</p>
      <p>I would rather say I am still learning than dress it up. If you work in security and have a view on where a developer should start, I want to hear it.</p>
    </div>
  </Section>
);

const Contact = () => (
  <Section label="Contact">
    <p className="font-serif text-lg leading-relaxed">
      Write to me about a project, a bug, or what I should learn next.
    </p>
    <ul className="mt-5 space-y-2 text-lg">
      <li><A href="mailto:johnjairuhochoa@gmail.com">johnjairuhochoa@gmail.com</A></li>
      <li><A href="https://github.com/zayhub13">github.com/zayhub13</A></li>
      <li><A href="assets/resume.pdf">Resume (PDF)</A></li>
    </ul>
  </Section>
);

const Footer = () => (
  <footer className="mt-8 bg-brick px-6 py-14 text-white md:pl-[8vw]">
    <div className="flex items-end gap-6">
      <Logo size={120} ink="#FFFFFF" accent="#FAFAFA" />
      <p className="pb-1 text-sm">John Jairuh Ochoa, Valenzuela City</p>
    </div>
  </footer>
);

const App = () => (
  <>
    <Top />
    <main>
      <Opening />
      <Argument />
      <Work />
      <Security />
      <About />
      <Contact />
    </main>
    <Footer />
  </>
);

ReactDOM.createRoot(document.getElementById('root')).render(<App />);
