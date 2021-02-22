
USE [ABN_Job_Portal]
GO

-- Posts View
CREATE VIEW [Posts] 
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[field]
		, [JobPosts].[description]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [Employers].[employerID]
		, [Employers].[profilePic]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict]
		, [Employers].[cityProvince]
		, [Employers].[brgyDistrict] 
			+ ', ' 
			+ [Employers].[cityProvince] 
		 AS [location]
	FROM [JobPosts]
	INNER JOIN [Employers]
		ON [JobPosts].[employerID] = [Employers].[employerID]
		AND [JobPosts].[jobPostFlag] = 1
GO

-- Job Details
CREATE VIEW [JobDetails]
AS
SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[field]
		, [JobPosts].[description]
		, [JobPosts].[responsibilities]
		, [JobPosts].[skills]
		, [JobPosts].[experiences]
		, [JobPosts].[education]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [JobPosts].[dateModified]
		, CAST([JobPosts].[jobPostFlag] AS INT) AS [jobPostFlag]
		, [Employers].[employerID]
		, [Employers].[profilePic]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict] + ', ' + [Employers].[cityProvince] AS [location]
		, [Employers].[contactNumber]
		, [Employers].[email]
		, [Employers].[website]
	FROM [JobPosts]
	INNER JOIN [Employers]
		ON [JobPosts].[employerID] = [Employers].[employerID]
GO 
