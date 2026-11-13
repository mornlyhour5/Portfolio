<section class="hero" id="top">
  <div class="wrap">
    <div>
      <p class="badge glass">Open to new opportunities</p>
      <h1>I build backend systems and the reports that run on them.</h1>
      <p class="lede">I'm <strong><?= e($profile['nickname']) ?></strong> (<?= e($profile['name']) ?>), an application developer at First Cambodia working with <strong>.NET, Report Builder and Power BI</strong>. My foundation is in backend architecture, Laravel, PostgreSQL and scalable full-stack systems.</p>
      <div class="actions">
        <a class="btn primary" href="#projects">See selected projects</a>
        <a class="btn glass" href="#contact">Get in touch</a>
      </div>
    </div>

    <figure class="code glass">
      <figcaption class="code-head">developer.py</figcaption>
      <pre><code><span class="k">class</span> <span class="c">Developer</span>:
    <span class="v">nickname</span> = <span class="s">"Star"</span>
    <span class="v">name</span> = <span class="s">"Morn Lyhour"</span>
    <span class="v">role</span> = <span class="s">".NET and backend"</span>
    <span class="v">stack</span> = [<span class="s">"Laravel"</span>, <span class="s">".NET"</span>, <span class="s">"Python"</span>]

    <span class="k">def</span> <span class="f">build_system</span>(<span class="v">self</span>):
        <span class="k">return</span> <span class="s">"Scalable and secure"</span>

<span class="v">dev</span> = <span class="c">Developer</span>()
<span class="f">print</span>(<span class="v">dev</span>.build_system())</code></pre>
    </figure>
  </div>
</section>
