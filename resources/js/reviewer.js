(() => {
'use strict';
const $ = id => document.getElementById(id);
const names = {all:'All subjects',logic:'Abstract & Logic',english:'English',science:'Science',math:'Mathematics',history:'History',filipino:'Filipino',civics:'General Knowledge & Philippine Constitution',reading:'Reading Comprehension'};
const bank = [
{subject:'math',prompt:'What is 25% of 200?',answer:'50',options:['25','40','50','75'],why:'25% is one-fourth; 200 ÷ 4 = 50.'},
{subject:'math',prompt:'What is 3/4 expressed as a decimal?',answer:'0.75',options:['0.34','0.75','1.25','0.43'],why:'3 divided by 4 is 0.75.'},
{subject:'math',prompt:'Simplify the ratio 12:18.',answer:'2:3',options:['2:3','3:2','6:9','4:9'],why:'Divide both numbers by their greatest common factor, 6.'},
{subject:'math',prompt:'What is 2.5 + 1.75?',answer:'4.25',options:['3.25','4.15','4.25','4.75'],why:'2.50 + 1.75 = 4.25.'},
{subject:'math',prompt:'A bag costs ₱800 and has a 10% discount. What is the discount amount?',answer:'₱80',options:['₱8','₱40','₱80','₱720'],why:'10% of ₱800 is ₱80.'},
{subject:'english',prompt:'Choose the grammatically correct sentence.',answer:'She has finished her assignment.',options:['She have finished her assignment.','She has finished her assignment.','She finishing her assignment.','She finish her assignment.'],why:'“She” takes “has” in the present perfect tense.'},
{subject:'english',prompt:'Which word is closest in meaning to “concise”?',answer:'Brief',options:['Confusing','Brief','Lengthy','Unclear'],why:'Concise means clear and brief.'},
{subject:'english',prompt:'Choose the correct word: “Neither of the answers ___ correct.”',answer:'is',options:['are','were','is','be'],why:'“Neither” is treated as singular here.'},
{subject:'science',prompt:'Which part of a plant primarily absorbs water from the soil?',answer:'Roots',options:['Flowers','Leaves','Roots','Fruit'],why:'Roots absorb water and minerals from soil.'},
{subject:'science',prompt:'What gas do plants absorb during photosynthesis?',answer:'Carbon dioxide',options:['Oxygen','Carbon dioxide','Hydrogen','Helium'],why:'Plants use carbon dioxide, water, and light to produce sugars.'},
{subject:'science',prompt:'Which planet is known as the Red Planet?',answer:'Mars',options:['Venus','Mars','Jupiter','Mercury'],why:'Iron-rich dust gives Mars its reddish appearance.'},
{subject:'logic',prompt:'What number comes next: 2, 4, 8, 16, ___?',answer:'32',options:['18','24','30','32'],why:'Each number is multiplied by 2.'},
{subject:'logic',prompt:'All roses are flowers. Which conclusion is definitely valid?',answer:'All roses are flowers.',options:['All flowers are roses.','All roses fade quickly.','All roses are flowers.','No roses fade.'],why:'This simply restates the premise.'},
{subject:'logic',prompt:'Find the odd one out: triangle, square, circle, carrot.',answer:'Carrot',options:['Triangle','Square','Circle','Carrot'],why:'The first three are shapes; carrot is a vegetable.'},
{subject:'history',prompt:'Who is widely recognized as the first President of the Philippines?',answer:'Emilio Aguinaldo',options:['Manuel Quezon','Emilio Aguinaldo','Jose Rizal','Andres Bonifacio'],why:'Emilio Aguinaldo headed the First Philippine Republic.'},
{subject:'history',prompt:'In what year was Philippine independence from Spain declared?',answer:'1898',options:['1521','1872','1898','1946'],why:'Independence was declared on June 12, 1898.'},
{subject:'filipino',prompt:'Ano ang kasingkahulugan ng salitang “masaya”?',answer:'Maligaya',options:['Malungkot','Galit','Maligaya','Pagod'],why:'Ang “maligaya” ay kasingkahulugan ng “masaya.”'},
{subject:'filipino',prompt:'Alin ang pangngalan sa pangungusap na “Nagbabasa ng aklat si Liza”?',answer:'Liza at aklat',options:['Nagbabasa','ng','Liza at aklat','si'],why:'Ang Liza ay pangalan ng tao at ang aklat ay pangalan ng bagay.'},
{subject:'civics',prompt:'How many branches of government are established in the Philippine system?',answer:'Three',options:['Two','Three','Four','Five'],why:'The branches are executive, legislative, and judicial.'},
{subject:'civics',prompt:'Which part of the 1987 Philippine Constitution contains the Bill of Rights?',answer:'Article III',options:['Article I','Article II','Article III','Article V'],why:'Article III contains the Bill of Rights.'},
{subject:'reading',prompt:'A paragraph says regular sleep helps memory, attention, and learning. What is its main idea?',answer:'Sleep supports learning and mental performance.',options:['Sleep is a waste of time.','Sleep supports learning and mental performance.','Only students need sleep.','Memory cannot improve.'],why:'All examples support the idea that sleep benefits mental performance.'},
{subject:'reading',prompt:'“Mara brought an umbrella because dark clouds covered the sky.” What can you infer?',answer:'She expected rain.',options:['She wanted shade from the sun.','She expected rain.','It was midnight.','She was going swimming.'],why:'Dark clouds and an umbrella suggest she expected rain.'},
{subject:'science',prompt:'Sound travels faster in a vacuum than through air.',answer:'False',options:['True','False'],why:'Sound needs a medium and cannot travel through a vacuum.',tf:true},
{subject:'history',prompt:'The Philippines is an archipelago.',answer:'True',options:['True','False'],why:'The Philippines consists of many islands.',tf:true},
{subject:'civics',prompt:'The Philippine Constitution is the supreme law of the country.',answer:'True',options:['True','False'],why:'The Constitution is the fundamental law of the Philippines.',tf:true},
{subject:'english',prompt:'“Their” and “there” have the same meaning.',answer:'False',options:['True','False'],why:'“Their” shows possession; “there” can refer to a place.',tf:true},
{subject:'math',prompt:'0.5 is equal to 1/2.',answer:'True',options:['True','False'],why:'Both represent one-half.',tf:true},
{subject:'filipino',prompt:'Ang pang-uri ay salitang naglalarawan sa pangngalan o panghalip.',answer:'True',options:['True','False'],why:'Tumutukoy ang pang-uri sa salitang naglalarawan.',tf:true},
{subject:'logic',prompt:'If every square is a rectangle, then every rectangle must be a square.',answer:'False',options:['True','False'],why:'A rectangle does not need four equal sides.',tf:true},
{subject:'math',prompt:'What do you call a number that represents a part of a whole, such as 3/5?',answer:'fraction',why:'A fraction represents part of a whole.'},
{subject:'english',prompt:'What part of speech names a person, place, thing, or idea?',answer:'noun',why:'A noun names a person, place, thing, or idea.'},
{subject:'science',prompt:'What process do plants use to convert light energy into chemical energy?',answer:'photosynthesis',why:'Photosynthesis uses light energy to produce sugars.'},
{subject:'history',prompt:'Who wrote Noli Me Tangere?',answer:'jose rizal',why:'Jose Rizal wrote Noli Me Tangere and El Filibusterismo.'},
{subject:'filipino',prompt:'Ano ang tawag sa salitang naglalarawan sa pangngalan o panghalip?',answer:'pang-uri',why:'Ang pang-uri ay naglalarawan sa pangngalan o panghalip.'},
{subject:'civics',prompt:'What is the fundamental law of the Philippines?',answer:'1987 philippine constitution',why:'The current Constitution was ratified in 1987.'},
{subject:'logic',prompt:'What type of reasoning draws a general conclusion from specific observations?',answer:'inductive reasoning',why:'Inductive reasoning moves from observations to a general pattern.'},
{subject:'reading',prompt:'What do you call the central point or message of a passage?',answer:'main idea',why:'The main idea is the central point of a passage.'}
];
const materialSubjects = {general:null,math:['math'],english:['english'],mock:['math','english','science','logic','history','filipino','civics','reading']};
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
document.querySelectorAll('.subject-card').forEach(c=>c.addEventListener('click',()=>setSubject(c.dataset.subject)));
$('quizSubject').addEventListener('change',e=>setSubject(e.target.value));
$('subjectSearch').addEventListener('input',e=>{const q=e.target.value.toLowerCase().trim();document.querySelectorAll('.subject-card').forEach(c=>c.classList.toggle('hidden',!c.textContent.toLowerCase().includes(q)));});
$('questionCount').addEventListener('input',updateCount);
$('countMinus').addEventListener('click',()=>{$('questionCount').value=Math.max(5,count()-5);updateCount();});
$('countPlus').addEventListener('click',()=>{$('questionCount').value=Math.min(20,count()+5);updateCount();});
document.querySelectorAll('input[name="quizType"]').forEach(i=>i.addEventListener('change',()=>document.querySelectorAll('.type-option').forEach(l=>l.classList.toggle('selected',l.querySelector('input').checked))));
document.querySelectorAll('input[name="material"]').forEach(i=>i.addEventListener('change',()=>document.querySelectorAll('.provided-card').forEach(l=>l.classList.toggle('chosen',l.querySelector('input').checked))));
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
  const mat=document.querySelector('input[name="material"]:checked')?.value||'general';
  list=bank.filter(q=>(!materialSubjects[mat]||materialSubjects[mat].includes(q.subject)||mat==='general')&&(s==='all'||q.subject===s));
  if(t==='truefalse')list=list.filter(q=>q.tf);
  if(t==='multiple')list=list.filter(q=>q.options?.length>2);
  if(t==='identification')list=list.filter(q=>!q.options||q.options.length>2);
  if(!list.length)list=bank.filter(q=>s==='all'||q.subject===s);
  list=shuffle(list);
  // If the selected material has fewer questions than requested, cycle through available items.
  const seed=[...list];while(list.length<n&&seed.length)list.push({...seed[list.length%seed.length]});
  list=list.slice(0,n).map(q=>{
   if(t==='truefalse'&&!q.tf){const trueStatement=Math.random()>.35;return {...q,answer:trueStatement?'True':'False',prompt:trueStatement?q.prompt:`${q.prompt} (This statement is false.)`,options:['True','False']};}
   if(t==='identification')return {...q,displayAnswer:q.answer,prompt:`Identify the correct answer:\n\n${q.prompt}`};
   return {...q};
  });
 }
 questions=shuffle(list).slice(0,n);if(!questions.length){error('No questions are available for that combination. Try another subject or material.');return;}
 index=0;answers=Array(questions.length).fill(null);
 $('quizTitle').textContent=activeTab()==='upload'?`Quiz: ${pdfFile.name}`:`${names[s]} practice quiz`;
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