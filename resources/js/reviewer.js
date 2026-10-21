(() => {
'use strict';
const $ = id => document.getElementById(id);
const names = {all:'All subjects',logic:'Abstract & Logic',english:'English',science:'Science',math:'Mathematics',history:'History',filipino:'Filipino',civics:'General Knowledge & Philippine Constitution',reading:'Reading Comprehension'};
const bank = JSON.parse($('mock-exam-data').textContent);
let pdfText='',pdfFile=null,questions=[],answers=[],index=0,toastTimer;
const normalize = v => String(v??'').toLowerCase().trim().replace(/[.,!?;:"'()[\]{}]/g,'').replace(/\s+/g,' ');
const shuffle = a => {a=[...a];for(let i=a.length-1;i>0;i--){const j=Math.floor(Math.random()*(i+1));[a[i],a[j]]=[a[j],a[i]];}return a;};
const type = () => document.querySelector('input[name="quizType"]:checked')?.value||'multiple';
const subject = () => $('quizSubject').value;
const count = () => Number($('questionCount').value);
const activeTab = () => document.querySelector('[data-tab].active')?.dataset.tab;
function toast(msg){const el=$('reviewerToast');el.textContent=msg;el.classList.add('visible');clearTimeout(toastTimer);toastTimer=setTimeout(()=>el.classList.remove('visible'),3000);}
function error(msg){$('builderError').textContent=msg||'';$('builderError').classList.toggle('hidden',!msg);}
function updateCount(){$('countOutput').textContent=count();$('estimatedTime').textContent='~'+Math.max(3,Math.ceil(count()*.45))+' minutes';}
function setSubject(s){$('quizSubject').value=s;document.querySelectorAll('.subject-card').forEach(c=>c.classList.toggle('selected',c.dataset.subject===s));}
function setMaterial(s){const material=[...document.querySelectorAll('input[name="material"]')].find(input=>input.value===s);if(material){material.checked=true;document.querySelectorAll('.provided-card').forEach(card=>card.classList.toggle('chosen',card.querySelector('input').checked));}}
document.querySelectorAll('.subject-card').forEach(c=>c.addEventListener('click',()=>{setSubject(c.dataset.subject);setMaterial(c.dataset.subject);}));
$('quizSubject').addEventListener('change',e=>{setSubject(e.target.value);setMaterial(e.target.value);});
$('subjectSearch').addEventListener('input',e=>{const q=e.target.value.toLowerCase().trim();document.querySelectorAll('.subject-card').forEach(c=>c.classList.toggle('hidden',!c.textContent.toLowerCase().includes(q)));});
$('questionCount').addEventListener('input',updateCount);
$('countMinus').addEventListener('click',()=>{$('questionCount').value=Math.max(5,count()-1);updateCount();});
$('countPlus').addEventListener('click',()=>{$('questionCount').value=Math.min(70,count()+1);updateCount();});
document.querySelectorAll('input[name="quizType"]').forEach(i=>i.addEventListener('change',()=>document.querySelectorAll('.type-option').forEach(l=>l.classList.toggle('selected',l.querySelector('input').checked))));
document.querySelectorAll('input[name="material"]').forEach(i=>i.addEventListener('change',()=>{
 document.querySelectorAll('.provided-card').forEach(l=>l.classList.toggle('chosen',l.querySelector('input').checked));
 setSubject(i.value);
}));
document.querySelectorAll('[data-tab]').forEach(t=>t.addEventListener('click',()=>{document.querySelectorAll('[data-tab]').forEach(b=>{b.classList.toggle('active',b===t);b.setAttribute('aria-selected',String(b===t));});document.querySelectorAll('[data-panel]').forEach(p=>p.classList.toggle('hidden',p.dataset.panel!==t.dataset.tab));error('');}));
$('browsePdf').addEventListener('click',()=>$('reviewerPdf').click());
$('uploadZone').addEventListener('click',e=>{if(!e.target.closest('button'))$('reviewerPdf').click();});
['dragover','dragenter'].forEach(ev=>$('uploadZone').addEventListener(ev,e=>{e.preventDefault();$('uploadZone').style.borderColor='#247c86';}));
['dragleave','drop'].forEach(ev=>$('uploadZone').addEventListener(ev,e=>{e.preventDefault();$('uploadZone').style.borderColor='';}));
$('uploadZone').addEventListener('drop',e=>{const f=e.dataTransfer.files?.[0];if(f)readPdf(f);});
$('reviewerPdf').addEventListener('change',e=>{const f=e.target.files?.[0];if(f)readPdf(f);});
$('removePdf').addEventListener('click',()=>{pdfText='';pdfFile=null;$('reviewerPdf').value='';$('uploadedFile').classList.add('hidden');$('uploadZone').classList.remove('hidden');$('extractStatus').textContent='ⓘ Text is extracted in your browser. Scanned/image-only PDFs need OCR, which is not included in this prototype.';toast('PDF removed.');});
async function readPdf(file){
 error('');
 if(!(file.type==='application/pdf'||file.name.toLowerCase().endsWith('.pdf'))){$('extractStatus').textContent='Please choose a PDF file.';return;}
 if(file.size>15*1024*1024){$('extractStatus').textContent='File exceeds 15 MB. Please choose a smaller PDF.';return;}
 pdfFile=file;pdfText='';$('fileName').textContent=file.name;$('fileMeta').textContent='Reading PDF text…';$('uploadedFile').classList.remove('hidden');$('uploadZone').classList.add('hidden');$('extractStatus').textContent='Loading PDF text extractor…';
 try{
  if(!window.pdfjsLib){await new Promise((resolve,reject)=>{const s=document.createElement('script');s.src='https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js';s.onload=resolve;s.onerror=()=>reject(Error('PDF.js failed to load'));document.head.appendChild(s);});}
  pdfjsLib.GlobalWorkerOptions.workerSrc='https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';
  const pdf=await pdfjsLib.getDocument({data:await file.arrayBuffer()}).promise;const pages=[];
  for(let n=1;n<=pdf.numPages;n++){const p=await pdf.getPage(n);const c=await p.getTextContent();pages.push(c.items.map(x=>x.str).join(' '));}
  pdfText=pages.join(' ').replace(/\s+/g,' ').trim();
  $('fileMeta').textContent=`${pdf.numPages} page(s) · ${(file.size/1048576).toFixed(2)} MB`;
  $('extractStatus').textContent=pdfText.length>80?`✓ Text extracted from ${pdf.numPages} page(s). Ready to create a practice quiz.`:'This PDF has little or no selectable text. Scanned PDFs need OCR, which is not included.';
 }catch(e){console.error(e);$('fileMeta').textContent='Text extraction failed';$('extractStatus').textContent='Could not read this PDF. Check internet access for PDF.js or choose another file.';}
}
function escapeReg(s){return s.replace(/[.*+?^${}()|[\]\\]/g,'\\$&');}
function fromPdf(txt,n,s,t){
 const sentences=[...new Set((txt.match(/[^.!?]+[.!?]?/g)||[]).map(x=>x.trim()).filter(x=>x.length>=35&&x.length<=260))];
 return shuffle(sentences).slice(0,n).map(sentence=>{
  const words=sentence.split(/\s+/).filter(w=>w.length>4&&/^[A-Za-z0-9-]+[,.;:]?$/.test(w));
  const keyword=words.map(w=>w.replace(/[,.;:]$/,'')).sort((a,b)=>b.length-a.length)[0]||'concept';
  const subj=s==='all'?'reading':s;
  if(t==='truefalse')return {subject:subj,prompt:`According to the uploaded reviewer, consider this source statement:\n\n“${sentence}”`,answer:'True',options:['True','False'],why:'This statement is reproduced from text extracted from your PDF.'};
  const masked=sentence.replace(new RegExp('\\b'+escapeReg(keyword)+'\\b','i'),'________');
  if(t==='identification')return {subject:subj,prompt:`Complete the statement from your reviewer:\n\n${masked}`,answer:normalize(keyword),displayAnswer:keyword,why:`Source sentence: “${sentence}”`};
  const distractors=shuffle(words.map(w=>w.replace(/[,.;:]$/,'')).filter(w=>normalize(w)!==normalize(keyword))).slice(0,3);
  while(distractors.length<3)distractors.push(['concept','example','process'][distractors.length]);
  return {subject:subj,prompt:`Based on your uploaded reviewer, complete the statement:\n\n${masked}`,answer:normalize(keyword),displayAnswer:keyword,options:shuffle([keyword,...distractors]),why:`Source sentence: “${sentence}”`};
 });
}
function build(){
 error('');const s=subject(),t=type(),n=count();let list=[];
 if(activeTab()==='upload'){
  if(!pdfFile){error('Upload a PDF first, or switch to Provided materials.');return;}
  if(pdfText.length<80){error('PDF text is not ready or could not be extracted. Use a text-based PDF.');return;}
  list=fromPdf(pdfText,n,s,t);
  if(!list.length){error('We could not find enough readable sentences in this PDF.');return;}
 }else{
  if(t!=='multiple'){error('The provided mock exams use multiple-choice questions. Select Multiple choice or upload your own PDF.');return;}
  const material=document.querySelector('input[name="material"]:checked')?.value||'all';
  if(material!=='all'&&s!=='all'&&material!==s){error('Choose the same subject for the mock exam and quiz subject.');return;}
  list=bank.filter(q=>(material==='all'||q.subject===material)&&(s==='all'||q.subject===s));
  if(list.length<n){error(`Only ${list.length} question(s) are available for this subject. Choose a smaller quiz.`);return;}
  list=shuffle(list).slice(0,n);
 }
 questions=shuffle(list).slice(0,n);if(!questions.length){error('No questions are available for that combination. Try another subject or material.');return;}
 index=0;answers=Array(questions.length).fill(null);
 const selectedSubject=s==='all'?(document.querySelector('input[name="material"]:checked')?.value||'all'):s;
 $('quizTitle').textContent=activeTab()==='upload'?`Quiz: ${pdfFile.name}`:`${names[selectedSubject]} practice quiz`;
 $('quizSubtitle').textContent=`${questions.length} questions · ${{multiple:'Multiple choice',truefalse:'True or false',identification:'Identification'}[t]} · ${activeTab()==='upload'?'Generated from your PDF text':'Provided practice material'}`;
 $('quizWorkspace').classList.remove('hidden');$('quizResult').classList.add('hidden');$('submitQuiz').disabled=false;$('submitQuiz').textContent='Finish quiz ✓';renderQuestion();$('quizWorkspace').scrollIntoView({behavior:'smooth',block:'start'});
}
function renderQuestion(){
 const q=questions[index],t=type();$('progressText').textContent=`Question ${index+1} of ${questions.length}`;$('progressPercent').textContent=`${Math.round((index+1)/questions.length*100)}%`;$('progressBar').style.width=`${(index+1)/questions.length*100}%`;
 $('questionSubject').textContent=names[q.subject]||'REVIEWER';$('questionNumber').textContent=`QUESTION ${String(index+1).padStart(2,'0')}`;$('questionPrompt').textContent=q.prompt;
 const area=$('answerArea');area.innerHTML='';
 if(t==='identification'){const input=document.createElement('input');input.className='identification-input';input.placeholder='Type your answer here…';input.value=answers[index]||'';input.autocomplete='off';input.addEventListener('input',()=>answers[index]=input.value);area.append(input);}
 else{const opts=t==='truefalse'?['True','False']:(q.options||['True','False']);shuffle(opts).forEach((opt,i)=>{const b=document.createElement('button');b.type='button';b.className='answer-option'+(answers[index]===opt?' selected':'');const letter=document.createElement('span');letter.className='option-letter';letter.textContent=String.fromCharCode(65+i);const text=document.createElement('span');text.textContent=opt;b.append(letter,text);b.addEventListener('click',()=>{answers[index]=opt;area.querySelectorAll('.answer-option').forEach(x=>x.classList.toggle('selected',x===b));});area.append(b);});}
 $('previousQuestion').disabled=index===0;$('previousQuestion').style.opacity=index===0?'.45':'1';$('nextQuestion').classList.toggle('hidden',index===questions.length-1);$('submitQuiz').classList.toggle('hidden',index!==questions.length-1);
}
function correct(q,a){if(a==null||String(a).trim()==='')return false;return normalize(a)===normalize(q.answer)||normalize(a)===normalize(q.displayAnswer);}
$('generateQuiz').addEventListener('click',build);$('nextQuestion').addEventListener('click',()=>{if(index<questions.length-1){index++;renderQuestion();}});$('previousQuestion').addEventListener('click',()=>{if(index>0){index--;renderQuestion();}});
$('editQuiz').addEventListener('click',()=>{$('quizWorkspace').classList.add('hidden');$('quizResult').classList.add('hidden');$('builderTitle').scrollIntoView({behavior:'smooth',block:'center'});});
$('submitQuiz').addEventListener('click',()=>{
 const score=questions.reduce((n,q,i)=>n+(correct(q,answers[i])?1:0),0),pct=Math.round(score/questions.length*100),result=$('quizResult');result.innerHTML='';
 const h=document.createElement('h3');h.textContent=`${score} out of ${questions.length} correct (${pct}%)`;
 const p=document.createElement('p');p.textContent=pct>=80?'Great work! Review the explanations below to strengthen your understanding.':'Keep practicing. Review the answers and explanations, then try another set.';
 const list=document.createElement('div');list.className='result-list';
 questions.forEach((q,i)=>{const ok=correct(q,answers[i]),item=document.createElement('div');item.className='result-item '+(ok?'correct':'wrong');const title=document.createElement('b');title.textContent=`${i+1}. ${ok?'✓ Correct':'✕ Incorrect'} — ${q.prompt}`;const a=document.createElement('div');a.textContent=`Your answer: ${answers[i]||'No answer'} · Correct answer: ${q.displayAnswer||q.answer}`;const why=document.createElement('div');why.textContent=q.why||'';item.append(title,a,why);list.append(item);});
 result.append(h,p,list);result.classList.remove('hidden');$('submitQuiz').disabled=true;$('submitQuiz').textContent='Quiz completed ✓';result.scrollIntoView({behavior:'smooth',block:'start'});
});
updateCount();
})();