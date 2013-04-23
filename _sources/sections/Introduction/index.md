---
title: Introduction
category: Introduction
---
After having your project fully tested, deployed and running, it seems the application architecture is pretty
good enough. All the requirements met and everybody is happy. But then as it happens,
the requirements change and you, all of sudden, find yourself in the time of troubles.
It comes out that some modules easier to hack than to modify. Change of other ones brings
endless changes in a cascade of dependent modules. Or you change one module and whole
the application starts to collapse like a house of cards. And, of course, you find
out that you can’t reuse already written modules for the new tasks, because the encapsulation of the desired parts
would take too much risk and work.  Robert C. Martin was very accurate naming those symptoms of rotting design as
[Viscosity, Rigidity, Fragility and Immobility](http://www.objectmentor.com/resources/articles/Principles_and_Patterns.pdf "Viscosity, Rigidity, Fragility and Immobility")

Well, the architecture tends to be refactored. You equip yourself with
[the list of heuristics](http://www.amazon.com/Clean-Code-Handbook-Software-Craftsmanship/dp/0132350882) and sniff over
the code for bad smells. Give enough efforts and time and you will find a lot of them.
So what are you going to do next? Will you try to find your own solution for every rotting spot just following
[the “solid” principles](http://en.wikipedia.org/wiki/SOLID)? Surely it comes on your mind that some thousands
of programmers been solving the exact issue already for hundred times with different programming languages.
It must be a pattern to follow. Here we come, that is exactly what
[Design Patterns](http://en.wikipedia.org/wiki/Software_design_pattern) are about. If you think that when you
have to design a module you can just pick a suitable snippet from your archive, give up.
It doesn’t work with Design Patterns. They are abstract concepts, which you should feel. When designing a module,
you take on account one or more due design patterns to build your own solution based on them. So, how to learn them, how to feel them?

Once on a W3C conference [Doug Schepers](http://www.w3.org/People/Schepers/)
asked the audience “Who of you is learning from the code?”
and everybody just laughed back. It was a rhetorical question.
Everybody learns mostly from the code, but guided by specifications and manuals.
For a software engineer an example of good designed code gives much more vision than pages of text explanations.
I think the best way to go with Design Patterns, that running each one through the playground.
Once implemented an approach, it makes easier to do it again when you need it. And here below I did it for myself.