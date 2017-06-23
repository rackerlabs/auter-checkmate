# Auter-checkmate
A central location for auter to update with information about the servers patching state

# Idea
To create a simple website to show the patching status of server in an environment

# But how
With a simple application which accepts web requests. The web request will be sent from each server that is running auter with the patching status to the server hosting this website.

#What information
Initially we will try to work on a traffic light type system:
 - green  = patched
 - orange = patching in progress
 - yellow = patches pending
 - red    = error

At a later stage we may look at adding some additional text info to the above statuses like the specific phase of auter that is being run:
 - enabled, idle
 - running ${phase} scripts
 - applying updates
 - rebooting
 - finalizing

Once we have the basics, we can then also look into having additional information per server (possibly and probably loaded on a separate page) with the updates available per server. It may also be useful to have this in a reportable format that we can have a summary of all servers with the patches staged for each server all shown on a single page
